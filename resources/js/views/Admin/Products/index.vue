<template>
    <div class="container-fluid">
        <div class="form-group mb-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="flex-between-center row">
                        <div class="col-md">
                            <ol class="breadcrumb mb-2 mb-md-0">
                                <li class="breadcrumb-item">
                                    <router-link to="/">Dashboard</router-link>
                                </li>
                                <li class="breadcrumb-item active">
                                    Products Management
                                </li>
                            </ol>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary btn-sm" v-on:click="showNewProductModal">
                                <span class="fa fa-plus"></span> Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <div class="card">
                <div class="card-body">
                    <b-table :fields="fields" :items="items" responsive="sm" :busy="loading">
                        <template v-slot:cell(image)="data">
                            <img :src="getAbsoluteImagePath(data.item.image)" :alt="data.item.name" width="53" />
                        </template>
                        <!-- Thêm slot action -->
                        <template v-slot:cell(deleteItem)="data">
                            <button  @click="deleteItem(data.item)" class="btn btn-danger btn-sm">
                                <span class="fa fa-trash"></span>
                            </button>
                            <button @click="editProduct(data.item)" class="btn btn-primary btn-sm">
                                <span class="fa fa-edit"></span>
                            </button>
                        </template>
                        <!-- Hiển thị animation "Loading Blocks" khi đang tải dữ liệu -->
                        <template #table-busy>
                            <div class="loading-blocks"></div> <!-- Sử dụng class "loading-blocks" cho animation -->
                        </template>
                    </b-table>
                </div>
            </div>
            <!-- Modal Create -->
            <b-modal ref="newProductModal" hide-footer title="Add New Category">
                <div class="d-block text-center">
                    <form v-on:submit.prevent="createProduct" class="text-left">
                        <div class="form-group">
                            <label for="name">Enter Name</label>
                            <input type="text" v-model="productData.name" class="form-control" id="name" placeholder="Enter product name"/>
                            <div class="invalid-feedback d-block" v-if="errors.name" >
                                {{ errors.name[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Choose an image</label>
                            <div v-if="productData.image">
                                <img src="" ref="newProductImageDispaly" class="w-100"/>
                            </div>
                            <input type="file" v-on:change="attachImage" ref="newProductImage" class="form-control" id="image"/>
                            <div class="invalid-feedback d-block" v-if="errors.image">
                                {{ errors.image[0] }}
                            </div>
                        </div>
                        <hr />
                        <div class="text-right">
                            <button type="button" class="btn btn-default" v-on:click="hideNewProductModal"> Cancel </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-check"></span> Save
                            </button>
                        </div>
                    </form>
                </div>
            </b-modal>

            <!-- Modal Update -->
            <b-modal ref="editProductModal" hide-footer title="Update Category">
                <div class="d-block text-center">
                    <form v-on:submit.prevent="updateProduct" class="text-left">
                        <div class="form-group">
                            <label for="name">Enter Name</label>
                            <input type="text" v-model="editProductData.name" class="form-control" id="name" placeholder="Enter product name"/>
                            <div class="invalid-feedback d-block" v-if="errors.name">
                                {{ errors.name[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Choose an image</label>
                            <div>
                                <img  :src="'../storage/'+editProductData.image"  ref="editProductImageDispaly" class="w-100"/>
                            </div>
                            <input type="file" v-on:change="editAttachImage" ref="editProductImage" class="form-control" id="image"/>
                            <div class="invalid-feedback d-block" v-if="errors.image">
                                {{ errors.image[0] }}
                            </div>
                        </div>
                        <hr />
                        <div class="text-right">
                            <button type="button" class="btn btn-default" v-on:click="hideEditProductModal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-check"></span> Update
                            </button>
                        </div>
                    </form>
                </div>
            </b-modal>
        </div>
    </div>
</template>
<script>
import * as productService from "../../../services/admin/product_service";
import axios from "axios";
export default {
    name: "product",
    data() {
        return {
            product: [],
            productData: {
                name: "",
                image: "",
            },
            fields: [
                { key: "counter", label: "#", sortable: true },
                { key: "id", sortable: true, class: "d-none" },
                { key: "image", sortable: true },
                { key: "name", sortable: true },
                { key: "deleteItem", label: "" },
            ],
            items: [],
            errors: {},
            editProductData: {},
            loading: true
        };
    },
    // mounted() là một lifecycle hook trong Vue.js, nó được gọi sau khi component đã được render hoàn toàn lên DOM
    mounted() {
        // Việc gọi this.loadProducts() trong mounted() đảm bảo rằng dữ liệu
        // sản phẩm được tải và gán vào biến this.product trước khi component được render lên DOM,
        // giúp đảm bảo dữ liệu đã được sẵn sàng để hiển thị trong giao diện người dùng.
        this.loadProducts();
    },

    methods: {
        // imagePath là đường dẫn tương đối của hình ảnh được truyền từ data.item.image. Phương thức getAbsoluteImagePath() sẽ trả về đường dẫn tuyệt đối HTTP của hình ảnh, sau đó được sử dụng trong thuộc tính src của thẻ <img>.
        getAbsoluteImagePath(imagePath) {
            const baseUrl = window.location.origin;
            const relativePath = imagePath;
            const absolutePath = baseUrl + '/' + relativePath;
            return absolutePath;
        },

        goToItemEditor(item) {
            const msg = "open complete editor for item, " + JSON.stringify(item);
        },

        updateCounter() {
            this.items.forEach((item, index) => {
                item.counter = index + 1;
            });
        },

        // Cập nhật biến product với danh sách sản phẩm mới
        refreshProductList() {
            this.loadProducts();
            // this.product = [...this.product];
        },

        
        // Xử lý dữ liệu update sản phẩm
        editProduct(item) {
            this.editProductData = { ...item };
            this.showEditProductModal();
        },

        loadProducts: async function () {
            try {
                // Load giá trị từ dữ liệu
                const jsonDataProduct = await productService.loadProducts();
                this.product = jsonDataProduct.data;

                // Đặt biến counter để lấy giá trị dán vào bảng table
                let counter = 1;
                this.items = this.product.map((item) => {
                    return {
                        counter: counter++,
                        id: item.id,
                        image: `../storage/${item.image}`,
                        name: item.name,
                    };
                });
                this.loading = false;
                console.log(this.items);
            } catch (error) {
                // Nếu quá trình load dữ liêu có vấn đề sẽ trả về lỗi
                this.flashMessage.error({
                    message: "Some error occurred, Please refresh!",
                    time: 5000,
                });
            }
        },

        attachImage(event) {
            // Kiểm tra nếu đối tượng input đã được định nghĩa và có giá trị
            if (event.target.files && event.target.files.length > 0) {
                // Gán giá trị của file đầu tiên vào thuộc tính "image" trong productData
                this.productData.image = event.target.files[0];
                // Kiểm tra nếu đã có hình ảnh được chọn, thì cập nhật đường dẫn hình ảnh
                if (this.productData.image) {
                    let reader = new FileReader();
                    reader.addEventListener(
                        "load",
                        (event) => {
                            this.$refs.newProductImageDispaly.src =
                                event.target.result;
                        },false);
                    reader.readAsDataURL(this.productData.image);
                }
            }
        },

        editAttachImage() {
            // Các dòng mã còn lại để load hình ảnh và hiển thị lên modal
            this.editProductData.image = this.$refs.editProductImage.files[0];
            let reader = new FileReader();
            reader.addEventListener(
                "load",
                function () {
                    this.$refs.editProductImageDispaly.src = reader.result;
                }.bind(this),false);
            reader.readAsDataURL(this.editProductData.image);
        },


        // Đóng modal của CreteProduct
        hideNewProductModal() {
            this.$refs.newProductModal.hide();
        },

        // Đóng modal của EditProduct
        hideEditProductModal() {
            this.$refs.editProductModal.hide();
        },
        // Mở modal của EditProduct
        showEditProductModal() {
            this.$refs.editProductModal.show();
        },

        // Mở modal của CreateProduct
        showNewProductModal() {
            this.$refs.newProductModal.show();
        },

        // Xử lý dữ liệu xoá createProduct
        deleteItem(item) {
            axios
                .delete(`/api/products/${item.id}`)
                .then((response) => {
                    // Xử lý phản hồi thành công
                    console.log(response.data);
                    // Xóa dữ liệu từ `items` dựa trên item được truyền vào
                    const index = this.items.findIndex((i) => i.id === item.id);
                    if (index !== -1) {
                        this.items.splice(index, 1);
                    }
                    this.updateCounter();
                })
                .catch((error) => {
                    this.flashMessage.error({
                        message: "Some error occurred, Please refresh!",
                        time: 5000,
                    });
                });
        },

        // Xử lý dữ liệu cập nhật createProduct
        updateProduct: async function() {
            try {
                this.loading = true;
                const formData = new FormData();
                formData.append('name', this.editProductData.name);
                formData.append('image', this.editProductData.image);
                formData.append('_method', 'put');
                const response = await productService.updateProduct(this.editProductData.id, formData)
                
                // Cập nhật sản phẩm trong mảng this.product
                this.product = this.product.map(product => {
                    if (product.id == response.data.id) {
                      for (let key in response.data) {
                        product[key] = response.data[key];
                      }
                    }
                });
                this.hideEditProductModal()
                this.flashMessage.success({
                    message: "Product updated successfully",
                    time: 5000,
                });
                this.loadProducts();
            } catch (error) {
                this.flashMessage.error({
                    message: "Some error occurred, Please refresh!",
                    time: 5000,
                });
            }
        },

        // Xử lý dữ liệu tạo mới createProduct
        createProduct: async function () {
            let formData = new FormData();
            formData.append("name", this.productData.name);
            formData.append("image", this.productData.image);
            try {
                this.loading = true;
                const response = await productService.createProduct(formData);
                if (response.data) {
                    // Thêm dữ liệu mới vào đầu mảng this.product
                    this.product.unshift(response.data);

                    // Cập nhật giao diện người dùng
                    this.refreshProductList();
                }
                // Ẩn modal nếu như thực hiện thao tác thêm thành công
                this.hideNewProductModal();
                this.flashMessage.success({
                    message: "Product stored successfully",
                    time: 5000,
                });
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.success({
                            message: "Some error occurred, Please try again",
                            time: 5000,
                        });
                        break;
                }
            }
        },
    },
};
</script>
<style scoped>
.loading-blocks {
  /* Định nghĩa animation cho loading blocks */
  /* Ví dụ: sử dụng CSS keyframes để thực hiện animation */
  width: 100px;
  height: 100px;
  background-color: #ccc;
  animation: loading-blocks 1s infinite;
}

@keyframes loading-blocks {
  0% {
    opacity: 0.2;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0.2;
  }
}
</style>