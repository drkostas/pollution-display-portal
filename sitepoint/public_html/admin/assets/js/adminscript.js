$(document).ready(function(){
  refreshTable();
});
function showindex()
{
	
    window.location="../..";
}
function refreshTable(){
    $('#progstations').load('../script/admintable.php', function(){
       setTimeout(refreshTable, 5000);
    });
}