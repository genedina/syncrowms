define([
    'underscore',
    'Magento_Ui/js/grid/columns/column'
], function (_, Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'Dnp_Syncrowms/ui/grid/cells/text'
        },
        getOrderStatusColor: function (row) {
            if (row.status == 'Success') {
                return 'complete-status';
            }else if(row.status == 'Error') {
                return 'closed-status';
            }
            return '#303030';
        }
    });
});
