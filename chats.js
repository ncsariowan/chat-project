
SELECTED_ID = -1;

LAST_CHAT_DATA = "";

LAST_SIDEBAR_DATA = "";


window.onload = function () {
    Chats.updateSidebar();

    //bind enter button
    $("#input").keypress(Chats.submitText);

    $("#new-conversation").click(Chats.updateNewConversationList);

    this.setInterval(
        function () {
            Chats.updateSidebar();
            Chats.personOnClick(SELECTED_ID);
        },
        1000
    );

}

Chats = {

    updateSidebar: function () {

        Utils.phpGet(
            "phpAPI/getMessageRecipients.php",
            {
                "userID": GLOBAL_VARS.userID
            },
            (response) => {

                if (LAST_SIDEBAR_DATA == response) {
                    return;
                }

                LAST_SIDEBAR_DATA = response;

                data = JSON.parse(response);

                if (data.length != 0) {

                    $("#conversations").empty();
                }


                for (e of data) {
                    elem = $($("#conversation-template").html());

                    $(elem).data("userID", e.userID);

                    $(elem).children(".conversation-name").text(e.firstName + " " + e.lastName);
                    $(elem).children(".last-message").text(
                        (e.fromUserID == GLOBAL_VARS["userID"] 
                            ? GLOBAL_VARS["firstName"] + " " + GLOBAL_VARS["lastName"]
                            : e.firstName + " " + e.lastName) 
                        + ": " + e.body);
                    $(elem).children(".last-time").text(Utils.formatDateTime(new Date(e.time)));

                    $(elem).click(function () {
                        Chats.personOnClick($(this).data("userID"));


                    });

                    $("#conversations").append(elem);
                }
            }
        );
    },

    /**
     * Generate message screen based on which user you choose.
     */
    personOnClick: function (userID) {

        if (userID < 0) {
            return;
        }


        SELECTED_ID = userID;

        $("#input").data("toUserID", userID);

        Utils.phpGet(
            "phpAPI/getUser.php",
            {
                userID: userID
            },
            function (response) {
                var e = JSON.parse(response)[0];
                $("#name").text(e.firstName + " " + e.lastName);
            }
        );

        Utils.phpGet(
            "phpAPI/getMessagesWithUser.php",
            {
                "userID": GLOBAL_VARS["userID"],
                "toUserID": userID
            }, (response) => {

                if (LAST_CHAT_DATA == response) {
                    return;
                }

                LAST_CHAT_DATA = response;

                var data = JSON.parse(response);

                $("#input-box").removeClass("hidden");
                $("#messages").empty();

                for (i in data) {

                    e = data[i];

                    var elem = $($("#message-template").html());

                    $(elem).children(".message-name").text(e.firstName + " " + e.lastName);
                    $(elem).children(".body").text(e.body);

                    if (e.userID == GLOBAL_VARS["userID"]) {
                        $(elem).addClass("user-message");
                    }

                    $("#messages").append(elem);


                    var eTime = new Date(e.time);
                    var makeTimeBreak = false;

                    if (data.length > parseInt(i) + 1) {
                        var f = data[parseInt(i) + 1];
                        var fTime = new Date(f.time);
                        // 900000 = 15 minutes
                        if (eTime.getTime() - fTime.getTime() > 900000) {
                            makeTimeBreak = true;
                        }
                    } else {
                        makeTimeBreak = true;
                    }

                    if (makeTimeBreak) {
                        var breakElem = $($("#time-break-template").html());
                        $(breakElem).children(".time").text(Utils.formatDateTime(eTime));
                        $("#messages").append(breakElem);
                    }
                    
                    $("#messages").scrollTop($("#messages").height())
                }
                
                $("#input").focus();
            }
        );

    },

    submitText: function (e) {
        if (e.which == 13) {

            var toUserID = $(e.currentTarget).data("toUserID");

            Utils.phpPost(
                "phpAPI/putMessage.php",
                {
                    body: $("#input").val(),
                    toUserID: toUserID,
                    userID: GLOBAL_VARS["userID"]
                },
                function (response) {
                    Chats.updateSidebar();
                    Chats.personOnClick(toUserID);
                }
            );

            $("#input").val('');

            return false;
        }
    },

    updateNewConversationList: function() {
        Utils.phpGet(
            "phpAPI/getAllUsers.php",
            {},
            function(response) {
                var data = JSON.parse(response);

                $("#contact-body").empty();

                for (e of data) {
                    var elem = $($("#contact-template").html());

                    $(elem).children(".contact-name").text(e.firstName + " " + e.lastName);
                    $(elem).children(".contact-username").text(e.username);

                    $(elem).data("userID", e.userID);

                    $(elem).click(function () {
                        Chats.personOnClick($(this).data("userID"));
                    
                        $("#close-modal").click();

                    });

                    $("#contact-body").append(elem);
                }
            }
        )
    }

    // newConversation: function() {

    // }
}

Utils = {
    phpGet: function (url, data, onSuccess) {
        $.ajax(
            url,
            {
                method: "GET",
                url: url,
                success: onSuccess,
                data: data
            }
        )
    },

    // dont worry about it...
    phpPost: function (url, data, onSuccess) {
        $.ajax(
            url,
            {
                method: "POST",
                url: url,
                success: onSuccess,
                data: data
            }
        )
    },

    formatDateTime: function (date) {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

        return date.toLocaleString('en-US', {
            hour12: true,
            hour: "numeric",
            minute: "numeric"
        })
            + ", "
            + monthNames[date.getMonth()] + " "
            + date.getDate();
    }

}

