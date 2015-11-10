<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Book Management System Realtime</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  </head>
  <body>
    <div id="wrapper">
      <div class="container">
        <h1 class="text-center">Book Management System Realtime</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Book Name</th>
              <th>Author</th>
              <th>Publisher</th>
              <th>Final Release Date</th>
              <th>Pages</th>
              <th>Read</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <h2 class="text-center">Add Book</h2>
        <form name="add-book" action="#" method="POST" role="form" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name</label>
            <div class="col-sm-10">
              <input type="text" name="book-name" class="form-control" placeholder="Book name" data-required="true" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="author">Author</label>
            <div class="col-sm-10">
              <input type="text" name="author" class="form-control" placeholder="Author" data-required="true" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="publisher">Publisher</label>
            <div class="col-sm-10">
              <input type="text" name="publisher" class="form-control" placeholder="Publisher" data-required="true" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="date">Final Release Date</label>
            <div class="col-sm-10">
              <input type="text" name="final-release-date" class="form-control" placeholder="Final Release Date" data-required="true" />
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pages">Pages</label>
            <div class="col-sm-10">
              <input type="text" name="pages" class="form-control" placeholder="Pages" data-required="true" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" data-add-book>Add Book</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
