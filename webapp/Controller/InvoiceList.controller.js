sap.ui.define([
    "sap/ui/core/mvc/Controller"
], function(Controller) {
    "use strict";
    return Controller.extend("sap.ui.demo.walkthrough.controller.HelloPanel", {
        deleteContact: function(id) {
            $.ajax({
                url: 'http://127.0.0.1/AgendaSAPUI5/back.php',
                type: "post",
                method: "post",
                data: {
                    action: "delete",
                    id: id
                },
                success: () => {
                    var data = this.getView().getModel().getData();

                    for (let i = 0; i < data.contacts.length; i++) {
                        if (data.contacts[i].id == id) {
                            data.contacts.splice(i, 1);
                        }
                    }
                    this.getView().getModel().setData(data);
                },

                error: function() {
                    alert("Error");

                }
            });

        }
    });
});