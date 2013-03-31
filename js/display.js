      var public_spreadsheet_url = 'https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0AmYzu_s7QHsmdE5OcDE1SENpT1g2R2JEX2tnZ3ZIWHc&output=html';

      jQuery(document).ready( function($) {
        Tabletop.init( { key: public_spreadsheet_url,
                         callback: showInfo,
                         wanted: [ "Cats", "Courses" ],
                         debug: true } )
      function showInfo(data, tabletop) {
        $("#table_info").text("We found the tables " + tabletop.model_names.join(", "));

        $.each( tabletop.sheets(), function(i, sheet) {
          $("#table_info").append("<p>" + sheet.name + " has " + sheet.column_names.join(", ") + "</p>");
        });

        $.each( tabletop.sheets("Cats").all(), function(i, cat) {
          var cat_li = $('<li><h4>' + cat.name + '</h4></li>')
          cat_li.append(cat.description);
          cat_li.appendTo("#cats");
        })

        $.each( tabletop.sheets("Courses").all(), function(i, course) {
          var cat_li = $('<li><h4>' + course.title + '</h4></li>')
          cat_li.append(course.description);
          cat_li.append("<p>Cost: $" + course.cost + "</p>");
          cat_li.appendTo("#courses");
        })
      }



      })

      document.write("The published spreadsheet is located at <a target='_new' href='" + public_spreadsheet_url + "'>" + public_spreadsheet_url + "</a>");    