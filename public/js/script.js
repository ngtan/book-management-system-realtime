$(document).ready(function() {
  var connect       = new WebSocket('ws://10.0.1.190:8080/');
  var addBookForm   = $('form[name="add-book"]');
  var addBookButton = $('[data-add-book]');

  var initialize = function(data) {
    var i = 0;
    var length = data.length;
    var tableBody = $('tbody');

    if (length === 0) {
      tableBody.append('<tr><td colspan="8" class="text-center success">No Results</td></tr>');
    } else {
      for (i = 0; i < length; i++) {
        tableBody.append([
          '<tr>',
            '<td>', (i + 1), '</td>',
            '<td>', data[i]['name'], '</td>',
            '<td>', data[i]['author'], '</td>',
            '<td>', data[i]['publisher'], '</td>',
            '<td>', data[i]['final_release_date'], '</td>',
            '<td>', data[i]['pages'], '</td>',
            '<td>', '<code>Read</code>', '</td>',
            '<td>', '<button class="btn btn-default btn-sm glyphicon glyphicon-remove"></button>', '</td>',
          '</tr>'
        ].join(''));
      }
    }
  };

  var insert = function(data) {
    var tableBody = $('tbody');
    var quantity = tableBody.children().length;

    tableBody.append([
      '<tr>',
        '<td>', (quantity + 1), '</td>',
        '<td>', data['name'], '</td>',
        '<td>', data['author'], '</td>',
        '<td>', data['publisher'], '</td>',
        '<td>', data['final_release_date'], '</td>',
        '<td>', data['pages'], '</td>',
        '<td>', '<code>Read</code>', '</td>',
        '<td>', '<button class="btn btn-default btn-sm glyphicon glyphicon-remove"></button>', '</td>',
      '</tr>'
    ].join(''));
  };

  connect.onopen = function(e) {
    console.log('Connection established!');
  };

  connect.onmessage = function(e) {
    var response = $.parseJSON(e.data);

    switch (response.type) {
      case 'init':
        initialize(response.data);
        break;

      case 'insert':
        insert(response.data);
        break;
    }
  };

  connect.onerror = function(e) {
    console.log('An error has occured: ', e);
  };

  connect.onclose = function(e) {
    console.log('Connection is closed!');
  };

  // submit "Add Book" form
  addBookForm.off('submit.addBook').on('submit.addBook', function(e) {
    e.preventDefault();

    addBookButton.trigger('click.addBook');
  });

  // click on "Add book" button
  addBookButton.off('click.addBook').on('click.addBook', function(e) {
    e.preventDefault();

    var dataRequired = $('[data-required]');
    var isValid      = true;
    var data = {};

    dataRequired.each(function() {
      var self = $(this);

      if (!self.val()) {
        self.focus();
        isValid = false;
        return false;
      }

      data[self.attr('name')] = self.val();
    });

    if (!isValid) {
      return false;
    }

    connect.send(JSON.stringify({
      type: 'insert',
      data: data
    }));

    addBookForm.trigger('reset');
  });
});
