(function($){
var public_spreadsheet_url = 'https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0AmYzu_s7QHsmdE5OcDE1SENpT1g2R2JEX2tnZ3ZIWHc&output=html';

/*
 You need to declare the tabletop instance separately, then feed it into the model/collection
 You *must* specify wait: true so that it doesn't try to fetch when you initialize
*/
var storage = Tabletop.init( { key: public_spreadsheet_url, wait: true } );

/*
 Need to specify that you'd like to sync using Backbone.tabletopSync
 Can specify tabletop attributes, or you can do it on the collection
*/
var Cat = Backbone.Model.extend({
  idAttribute: 'name',
  tabletop: {
    instance: storage,
    sheet: 'Cats'
  },
  sync: Backbone.tabletopSync
});

/*
 Need to specify that you'd like to sync using Backbone.tabletopSync
 Need to specify a tabletop key and sheet
*/
var CatCollection = Backbone.Collection.extend({
  // Reference to this collection's model.
  model: Cat,
  tabletop: {
    instance: storage,
    sheet: 'Cats'
  },
  sync: Backbone.tabletopSync
});

var CatView = Backbone.View.extend({
  tagname: 'div',
  template: _.template( '<div class="wptt-entry"><h2><%= name %>!</h2><h3>age <%= age %></h3><div class="body"><%= description %></div></div>'),
  render: function() {
    $(this.el).html(this.template(this.model.toJSON()));
    return this;
  }
});

/*
 You need to initialize Tabletop before you do aaaaanything.
 You might think it'd be a good idea to put that into backbone.tabletopSync,
 but IMHO the fact that you could put the key/url into any model anywhere
 ever sounds like trouble.
*/
  var cats = new CatCollection();
  cats.fetch({ success: showInfo });

function showInfo(cats) {
  var bosco_view = new CatView({ model: cats.get('Bosco') });

  $("#wptt-content").append( bosco_view.render().el );

  /*
   Fetching on models works as long as you've specified a sheet
   and an idAttribute for the Backbone.Model (you can always
   use rowNumber, it comes baked in to Tabletop)
  */
  var thomas = new Cat({name: 'Thomas'});
  thomas.fetch();

  var thomas_view = new CatView({ model: thomas });
    $("#wptt-content").append( thomas_view.render().el );

  $('#wptt-content').append("The published spreadsheet is located at <a target='_new' href='" + public_spreadsheet_url + "'>" + public_spreadsheet_url + "</a>");

}

}(jQuery));