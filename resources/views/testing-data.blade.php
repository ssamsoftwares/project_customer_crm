<!doctype html>
<html lang="en">
  <head>
    <title>Editor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>

  <style>
    /* Adjust the size of the CKEditor textarea */
    .ck-editor__editable_inline {
        min-height: 300px; /* Adjust the height as needed */
        overflow-y: auto;  /* Add vertical scrollbar */
        border: 1px solid #ccc; /* Optional: Add border for clarity */
        padding: 10px; /* Optional: Add padding for spacing */
    }
</style>

  <body>

    <div class="container mt-4">
    <form action="" method="post">
        <div class="form-group">
          <label for="desc1">Desc1</label>

          <textarea name="desc12" id="editor" cols="40" rows="20" class="form-control"></textarea>

        </div>

        <div class="form-group">
            <label for="desc1">Desc2</label>

            <textarea name="desc12" id="" cols="40" rows="20" class="form-control"></textarea>
          </div>


    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
</script>
  </body>
</html>
