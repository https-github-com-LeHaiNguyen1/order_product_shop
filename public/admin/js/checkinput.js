const emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
function checkinputLogin() {
  // Lấy giá trị của email, password, passwordConfirm từ các form input.
  var email = $('#email').val();
  console.log(email);
  var password = $('#password').val();
  // Nếu email được nhập đúng
if (emailRegex.test(email)) {
  $('#email').removeClass('is-invalid');
  $('#email-error').text(''); // xóa nội dung span error-msg
}

// Nếu password được nhập đúng
if (password) {
  $('#password').removeClass('is-invalid');
  $('#password-error').text(''); // xóa nội dung span error-msg
}
  // Nếu người dùng không nhập email.
  if (!email) {
    $('#email').addClass('is-invalid');
    $('#email-error').text('Please enter your email.'); // Cập nhật nội dung của span error-msg.
    return false;
  }
  if (!emailRegex.test(email)) {
    $('#email').addClass('is-invalid');
    $('#email-error').text('Please enter a valid email address.');
    return false;
  }


  // Nếu người dùng không nhập password 
  if (!password) {
    $('#password').addClass('is-invalid');
    $('#password-error').text('Please enter a your password.');
    return false;
  }


  // Nếu tất cả các thao tác trên đều thành công.
  return true;
}
function checkinputRegister() {
  // Lấy giá trị của email, password, passwordConfirm từ các form input.
  var name = $('#name').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var passwordConfirm = $('#password-confirm').val();
  // Nếu email được nhập đúng
if(name){
    $('#name').removeClass('is-invalid');
    $('#name-error').text(''); // Cập nhật nội dung của span error-msg.
}
if (emailRegex.test(email)) {
  $('#email').removeClass('is-invalid');
  $('#email-error').text(''); // xóa nội dung span error-msg
}
// Nếu password được nhập đúng
if (password) {
  $('#password').removeClass('is-invalid');
  $('#password-error').text(''); // xóa nội dung span error-msg
}
if(password == passwordConfirm){
  $('#password-confirm').removeClass('is-invalid');
  $('#password-confirm-error').text(' ');
}
  // Nếu người dùng không nhập name.
  if(!name){
    $('#name').addClass('is-invalid');
    $('#name-error').text('Please enter your name.'); // Cập nhật nội dung của span error-msg.
  }
  // Nếu người dùng không nhập email.
  if (!email) {
    $('#email').addClass('is-invalid');
    $('#email-error').text('Please enter your email.'); // Cập nhật nội dung của span error-msg.
    return false;
  }
  if (!emailRegex.test(email)) {
    $('#email').addClass('is-invalid');
    $('#email-error').text('Please enter a valid email address.');
    return false;
  }
  // Nếu người dùng không nhập password 
  if (!password) {
    $('#password').addClass('is-invalid');
    $('#password-error').text('Please enter a your password.');
    return false;
  }
  if(password != passwordConfirm){
    $('#password-confirm').addClass('is-invalid');
    $('#password-confirm-error').text('password incorrect');
  }

  // Nếu tất cả các thao tác trên đều thành công.
  return true;
}

function Checklogin() {
  $('#successModal').modal('show');
  setTimeout(function() {
    window.location.href = "{{ route('login') }}";
  }, 3000); // Chuyển hướng sau 3 giây.
  return true;
}