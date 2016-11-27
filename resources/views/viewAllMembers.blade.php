@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <div class="container">

        <!-- private -->


<!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" >
                        <button type="button" class="close" id ="close-button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="myModalTitle">Modal Header</h4>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 well well-lg" style="background-color: #F5F5DC">





                            <div class="row well">
                                <div id="chat-output" class="col-sm-12">
                                    <ul id="chat-messages" class="list-group">
                                    </ul>
                                </div>
                            </div>
                            <div class="row well">
                                <div id="chat-control" class="col-sm-8" style="position: relative;
    display: block;
    width: 100%;
    border: 0px solid;
    padding: 0px;
    height:20%;">
                                    <div class="message-console-send-area" class="col-sm-10">

                                        <textarea class="console-message" id="console-message-input" placeholder="Your message....."></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button" class="btn btn-default btn-lg" id="send-button">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.1.1.js"></script>

        <script>

            // Initialize pubnub for private messaging
            console.log("Initializing PubNub instance for private messaging...");
            //var pubkey = "pub-c-806c421e-8b39-48a1-b3c7-e92a4ece249d";
            //var subkey = "sub-c-0b0a8f74-49f6-11e6-85a4-0619f8945a4f";
            var pubkey = "demo-36";
            var subkey = "demo-36";
            var myPubnub = new PubNub({
                publishKey:   pubkey,
                subscribeKey: subkey,
            });


            // Get the modal
            var modal = document.getElementById('myModal');

            // When the user clicks on (x), close the modal
            document.getElementById('close-button').onclick = function() {
                clearMessages();
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it too
            window.onclick = function(event) {
                if (event.target == modal) {
                    clearMessages();
                    modal.style.display = "none";
                }
            }

            function clearMessages() {
                // clear the message input
                document.querySelector("#console-message-input").value = '';
                // clear the message output
                var list = document.getElementById("chat-messages");
                while (list.hasChildNodes())
                    list.removeChild(list.firstChild);
                console.log("clear");
            }

            function openMsg(myName, myID, targetName, targetID) {

                document.getElementById('console-message-input').onkeypress=function(e){
                    if(e.keyCode==13)
                        document.getElementById('send-button').click();
                }

                document.getElementById("myModalTitle").innerHTML = targetName;
                console.log("Private messages from you (", myID, ") to ", targetName, " (", targetID, ")");


                // Add listener
                console.log("Adding listener...");
                myPubnub.addListener({

                    message: function(event) {
                        // handle message
                        var formattedTime = formatTimeToken(event.timetoken);
                        var text = event.message.text;
                        var fromUser = event.message.from;
                        addChatMessage(text, formattedTime, fromUser);
                        console.log("get the message: ", text);
                    },
                    presence: function(p) {
                        // handle presence
                    },
                    status: function(s) {
                        // handle status
                    }
                });

                // Subscribing to the chat-channel between you and target
                var chat_channel = ((myID < targetID)? myID.toString().concat(targetID.toString()): targetID.toString().concat(myID.toString()));
                console.log("Subscribing to chat-channel", chat_channel, "...");

                myPubnub.subscribe({
                    channels: [chat_channel]
                });

                // Get history of conversation
                console.log("Getting the history...");
                myPubnub.history(
                        {
                            channel: chat_channel,
                            includeTimetoken: true,
                            count: 20
                        },
                        function (status, response) {

                            response['messages'].forEach(
                                    function(msg) {
                                        console.log("The message: ", msg);

                                        addChatMessage(
                                                msg.entry.text,
                                                formatTimeToken(msg.timetoken),
                                                msg.entry.from
                                        );

                                    }
                            );

                        }
                );

                // The Publish function to publish to the channel
                function publish() {
                    var messageText = document.querySelector("#console-message-input");
                    var msg = {
                        from: myName,
                        text: messageText.value
                    };

                    myPubnub.publish(
                            {
                                message: msg,
                                channel: chat_channel
                            },
                            function (status, response) {
                                if (status.error) {
                                    console.log(status)
                                }
                                else {
                                    console.log("message Published w/ timetoken", response.timetoken)
                                }
                            }
                    );

                    messageText.value = '';
                }
                document.getElementById('send-button').onclick = publish;

                modal.style.display = "block";
            }

            function addChatMessage(messageText, timeStamp, fromUser) {
                if (!messageText) return; // someone sent data outside of the UI (using REST for example) so ignore it
                var nPanel = document.createElement("div");
                nPanel.className = "panel panel-default";

                var nPanelHeader = document.createElement("div");
                nPanelHeader.className = "panel-heading";
                nPanelHeader.innerHTML =
                        '<h3 class="panel-title msg-header">'
                        + fromUser  + ' wrote at: ' + timeStamp + '</h3>';

                nPanel.appendChild(nPanelHeader);

                var nPanelContent = document.createElement('div');
                nPanelContent.className = "panel-body";

                var newChatMessage = document.createElement("div");
                newChatMessage.innerHTML = '<p><span>'  + messageText.replace( /[<>]/ig, '' ) + '</span></p>';
                newChatMessage.className = "chat-message";

                nPanelContent.appendChild(newChatMessage);
                nPanel.appendChild(nPanelContent);

                var chatMessageLst = document.querySelector("#chat-messages");
                var newChatMessageListItem = document.createElement("li");
                newChatMessageListItem.className = "list-group-item";
                newChatMessageListItem.appendChild(nPanel);
                //append it to the list
                chatMessageLst.appendChild(newChatMessageListItem);


                var div = $("#chat-output")[0];
                // certain browsers have a bug such that scrollHeight is too small
                // when content does not fill the client area of the element
                var scrollHeight = Math.max(div.scrollHeight, div.clientHeight);
                div.scrollTop = scrollHeight - div.clientHeight;

            }

            function formatTimeToken(timeToken) {
                var date = new Date(timeToken/10000);
                var month = date.getMonth()+1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hours = date.getHours();
                var minutes = "0" + date.getMinutes();
                var seconds = "0" + date.getSeconds();

                var formattedTime =
                        year + '-' + month + '-' + day + " " +
                        hours + ':' +
                        minutes.substr(minutes.length-2) + ':' +

                        seconds.substr(seconds.length-2);
                return formattedTime;
            }

            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }







        </script>
        <!-- -->

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #F5F5DC; ">Chat with Members of {{$society->name}} (Click on names to start chatting!)</div>
            @if(Auth::check())
                <!-- Make a horizontal menu here -->
                    <ul style=" list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                    background-color: 	#F8F8F8;
">
                        <li style="float: left;"><a href="{{ url(action('DiscussionController@show', ['society_id'=>$society->id]))}}"
                                                    style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Back to {{$society->name}}</a>
                        </li>
                    </ul>
                    <!-- Table -->
                    <table class="table" >
                        <tr>
                            <th>Name</th>
                            <th>University Year</th>
                            <th>Registered at</th>
                        </tr>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <span id="200300400" onclick="openMsg('<?php echo \Illuminate\Support\Facades\Auth::user()->name;?>', '<?php echo \Illuminate\Support\Facades\Auth::user()->id;?>', '<?php echo $member->name;?>', '<?php echo $member->id;?>')" >{{$member->name}} </span>
                                </td>
                                <td>{{$member->university_year}}</td>
                                <td>{{$member->created_at}}</td>
                                <td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
            @if(Auth::guest())
                <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
            @endif
        </div>
    </div>
    </div>
@endsection

