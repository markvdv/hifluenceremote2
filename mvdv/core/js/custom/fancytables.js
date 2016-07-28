var Fancytables = function () {
    /**
     * rowindex is used for adding a row to the dtatable after formsubmit
     */
    this.rowindex = false;
    /**
     * 
     * @type window.jQuery|jQuery
     */
    this.currenttables;
    /**
     * sets up the datatable for a table element
     * @param {type} table
     * @returns {undefined}
     */
    this.dataTableSetup = function (table) {
        jQuery(table).DataTable(
                {
                    "autoWidth": false,
                    ajax: {
                        type: "POST",
                        url: table.parentNode.dataset['ajax']
                    }, order: [0, 'desc']
                });
    };/**
     * gets collection of table s on page and checks if they have a dtatable set if not it sets it
     * @returns {undefined}
     */
    this.bindDataTables = function () {
        var fancytables = this;
        this.currenttables = jQuery('table');
        this.currenttables.each(function (key, value) {
            if (!$.fn.DataTable.isDataTable(value)) {
                fancytables.dataTableSetup(value);
            }
        })
    };

}


jQuery(function () {
    /**
     * 
     * @type window.jQuery|jQuerysetup datatables for tables that dont have it yet
     */
    var fancytable = new Fancytables();
    fancytable.bindDataTables();
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="actionform setup">


    //<editor-fold defaultstate="collapsed" desc="listen to ajax success calls to manipulate table data and draw it">
    //to add another row after using the acompanying form
    jQuery(document).ajaxSuccess(function (event, xhr, ajaxoptions, data) {
        //setup datatables if necessary
        fancytable.bindDataTables();


//        //add row to corresponding table
//        if (ajaxoptions.url.indexOf("http") === 0) {//check if http in url to recognize form
//            try {
//                var data = JSON.parse(data);
//                var i = 0;
//                datatables.iterator('table', function () {
//                    if (parentNode[i].id === data.targettableid) {
//                        if (fancytable.rowindex === false) {//means its a new row
//                            datatables.table(i).row.add(data.entity).draw();
//                        } else {
//                            datatables.row(fancytable.rowindex).data(data.entity).draw();
//                        }
//                    }
//                    i++;
//                });
//            } catch (e) {
//
//            }
//        }
    }
    )
    //</editor-fold>
});