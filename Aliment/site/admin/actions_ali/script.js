document.addEventListener('DOMContentLoaded', function() {
  var inputs = document.querySelectorAll('.custom-file input[type="file"]');
  Array.prototype.forEach.call(inputs, function(input) {
      var button = input.nextElementSibling;

      button.addEventListener('click', function() {
          input.click();
      });

      input.addEventListener('change', function(e) {
          var fileName = '';
          if (this.files && this.files.length > 1) {
              fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
          } else {
              fileName = e.target.value.split('\\').pop();
          }

          if (fileName) {
              button.innerHTML = fileName;
          } else {
              button.innerHTML = 'Escolher arquivo';
          }
      });
  });
});
