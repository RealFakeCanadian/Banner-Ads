function updateDBItem(tablename,id,columnname,columnvalue) {
    $("#console_log_display").text(tablename);

console.log("_ajaxcommands.php?tablename="+tablename+"&rowid="+id+"&columnname="+columnname+"&columnvalue="+columnvalue);
    $.ajax({
        url: "_ajaxcommands.php?tablename="+tablename+"&rowid="+id+"&columnname="+columnname+"&columnvalue="+columnvalue,
        success: function(data) {
            $("#console_log_display").text(data);
        }
    });
}