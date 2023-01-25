const validator = new JustValidate('#add-product');

validator
  .addField('#title', [
    {
      rule: 'required',
      errorMessage: 'Product\'s title is required',
    },
    {
        rule: 'minLength',
        value: 4,
        errorMessage: 'Product\'s title must be 4 chars length at least',
    },
    {
        rule: 'maxLength',
        value: 255,
        errorMessage: 'Product\'s title must be 255 chars length at most',
    },
])
.addField('#quantity', [
    {
        rule: 'required',
        errorMessage: 'Product\'s quantity is required',
    }
])
.addField('#img', [
    {
        rule: 'minFilesCount',
        value: 1,
        errorMessage: 'Product\'s image is required',
    },
    {
        rule: 'maxFilesCount',
        value: 1,
        errorMessage: 'Only one image is allowed',
    }
])
.addField('#price', [
    {
        rule: 'required',
        errorMessage: 'Product\'s price is required',
    }
])
.onSuccess((event) => {
    document.getElementById("add-product").submit();
});

