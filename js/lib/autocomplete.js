$(document).ready(function() {
  var numbers;

  numbers = new Bloodhound({
    datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: [
      { num: 'one' },
      { num: 'two' },
      { num: 'three' },
      { num: 'four' },
      { num: 'five' },
      { num: 'six' },
      { num: 'seven' },
      { num: 'eight' },
      { num: 'nine' },
	  { num: 'ttasine' },
	  { num: 'tthjkine' },
	  { num: 'twjyne' },
	  { num: 'twjjtjtjdne' },
	  { num: 'tyertne' },
	  { num: 'twdine' },
      { num: 'tden' }
    ]
  });

  numbers.initialize();

  $('.autocomplete .typeahead').typeahead(null, {
    displayKey: 'num',
    source: numbers.ttAdapter()
  });



});
