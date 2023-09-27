const imputs = document.querySelectorAll('input');

imputs.forEach((input) => {
  input.onfocus = function(){
    input.previousElementSibling.classList.add('top')
    input.previousElementSibling.classList.add('focus')
    input.parentNode.classList.add('focus')
  }
    input.onblur = function(){
        input.value=input.value?.trim();
        if(input.ariaValueMax?.trim().length==0){
        input.previousElementSibling.classList.remove('top')
    }
        input.previousElementSibling.classList.remove('focus')
        input.parentNode.classList.remove('focus')
    }
  });


  const textareas = document.querySelectorAll('textarea');

  textareas.forEach((textarea) => {
    textarea.onfocus = function(){
      textarea.previousElementSibling.classList.add('top')
      textarea.previousElementSibling.classList.add('focus')
      textarea.parentNode.classList.add('focus')
    }
      textarea.onblur = function(){
          textarea.value=input.value?.trim();
          if(input.ariaValueMax?.trim().length==0){
          textarea.previousElementSibling.classList.remove('top')
      }
          textarea.previousElementSibling.classList.remove('focus')
          textarea.parentNode.classList.remove('focus')
      }
    });