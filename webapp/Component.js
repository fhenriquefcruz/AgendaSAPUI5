sap.ui.define([
    "sap/ui/core/UIComponent",
    "sap/ui/model/json/JSONModel"
], function(UIComponent, JSONModel) {
    "use strict";
    return UIComponent.extend("sap.ui.demo.walkthrough.Component", {
        metadata: {
            manifest: "json"
        },
        init: function() {

            UIComponent.prototype.init.apply(this, arguments);

            this.contactsData = {
                contacts: [],
                recipient: {
                    name: "",
                    sobrenome: "",
                    telefone: "",
                    email: ""
                }
            };
            this.list()

        },
        list: function() {
            var oModel = new JSONModel(this.contactsData);
            this.setModel(oModel);

            $.ajax({
                url: 'http://127.0.0.1/AgendaSAPUI5/back.php',
                dataType: 'jsonp',
                success: (json) => {
                    this.contactsData.contacts = json
                    oModel = new JSONModel(this.contactsData);
                    this.setModel(oModel);
                },
                error: function() {
                    alert("Error");
                }
            });
        }

    });
});