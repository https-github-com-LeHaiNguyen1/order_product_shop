<template>
    <main>
        <div id="wrapper">
            <Sidebar />
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <Header />
                    <router-view></router-view>
                </div>
                <Footer />
            </div>
        </div>
        <FlashMessage position="right top"></FlashMessage>
    </main>
</template>

<script>
 import Header from './components/Header.vue'
 import Sidebar from './components/Sidebar.vue'
 import Footer from './components/Footer.vue'
    export default {
        components: {
            Header,
            Sidebar,
            Footer
        }
    }
</script>

<style>

</style>