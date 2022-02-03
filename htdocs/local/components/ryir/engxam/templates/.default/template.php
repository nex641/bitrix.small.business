<script>
    BX.ajax.runComponentAction('ryir:engxam', 'word', {
    mode: 'class',
  	data: {
    id: '6',
    lang: 'ru'
  }
}).then(function (response) {
    console.log(response);
});
BX.ajax.runComponentAction('ryir:engxam', 'list', {
    mode: 'class',
}).then(function (response) {
    console.log(response);
})
</script>
