<html>
    <head>
        <title>Search</title>
        <!-- load jquery ui css-->
        <link href="http://<?php echo $_SERVER['HTTP_HOST'];?>/DBMS_NEW/DBMS/admin/search/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
        <!-- load jquery library -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- load jquery ui js file -->
        <script src="http://<?php echo $_SERVER['HTTP_HOST'];?>/DBMS_NEW/DBMS/admin/search/jqueryui/jquery-ui.min.js"></script>
        <style type="text/css">
            .ui-autocomplete-category {
                font-weight: bold;
                padding: .2em .4em;
                margin: .8em 0 .2em;
                line-height: 1.5;
              }
        </style>
                <script>
  $( function() {
        $.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;
          if ( item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category ) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
        });
      }

    });
        var availableTags = <?php include('./search/search.php') ?>;
            console.log(availableTags);

            $("#pinsta").catcomplete({
                source: availableTags,
                autoFocus:false,
                select: function( event, ui ) {
                        console.log( "Selected: " + ui.item.value + " aka " + ui.item.category );
                        var a = ui.item.category;
                        var b = ui.item.value;
                        console.log(b);
                          window.location.href = "http://<?php echo $_SERVER['HTTP_HOST'];?>/DBMS_NEW/DBMS/admin/search/decide.php?searchcategory=" + a+"&searchquery="+b; 

                            
                      }

            });
     
         

});
 


    </script>
    </head>
    <body>
    <form action="./search/typed.php" method="POST">
        <!-- <label>Search Pinstagram</label></br> -->
        <input id="pinsta" type="text" size="50" name="search_query" placeholder="Search Pinstagram" />
        <input type="submit" name="submit">
    </form>
    </body>
</html>