const successfulMsg = $(".flash_msg").data("successful");
const failedMsg = $(".flash_msg").data("failed");
const goofyMsg = $(".flash_msg").data("goofy");
const Toast = Swal.mixin({
  toast: true,
  position: "top",
  showConfirmButton: false,
  timer: 3000,
});

if (successfulMsg) {
  Toast.fire({
    icon: "success",
    title: successfulMsg,
  });
} else if (failedMsg) {
  Toast.fire({
    icon: "warning",
    title: failedMsg,
  });
} else if (goofyMsg) {
  Toast.fire({
    icon: "error",
    title: goofyMsg,
  });
}
