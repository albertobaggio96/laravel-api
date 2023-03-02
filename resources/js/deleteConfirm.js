const deleteElementConfirm = document.querySelectorAll("form.delete-element")

deleteElementConfirm.forEach((formElement)=>{
  formElement.addEventListener("submit", function(event){
    event.preventDefault();
    const formElementName= formElement.getAttribute("data-element-name")
    Swal.fire({
      title: `Are you sure to delete "${formElementName}"?`,
      text: "You will find it to the trash",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, do it!',
      title: 'Custom animation with Animate.css',
      // showClass: {
      //   popup: 'pop-up'
      // },
      // hideClass: {
      //   popup: ''
      // }
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          `Your project "${formElementName}" has been moved to trash.`,
          'success'
        )
        formElement.submit()
      }
    })
  })
})

const forceDeleteElementConfirm = document.querySelectorAll("form.force-delete-element")

forceDeleteElementConfirm.forEach((formElement)=>{
  formElement.addEventListener("submit", function(event){
    event.preventDefault();
    const formElementName= formElement.getAttribute("data-element-name")
    Swal.fire({
      title:  `Are you sure to delete "${formElementName}"?`,
      text: "Please confirm your request !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Yes, confirm !'
    }).then((result) => {
      if (result.value) {
        Swal.fire({
          title: 'Confirm request',
          html: "Please type <b>CONFIRM</b>",
          input: 'text',
          type: 'warning',
          inputPlaceholder: 'CONFIRM',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          allowOutsideClick: () => !Swal.isLoading(),
          preConfirm: (txt) => {
            return (txt === "CONFIRM");
          },

        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              `Your project "${formElementName}" has been deleted.`,
              'success'
            )
            formElement.submit()
          }
        })
      }
    });
  });
});