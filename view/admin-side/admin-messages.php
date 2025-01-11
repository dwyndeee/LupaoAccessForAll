<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter" id="unread_count">...</span>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header d-flex justify-content-between align-items-center">
            <span>Message Center</span>
            <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#selectUser">Send Message To:</button>
        </h6>

        <!-- Message List -->
        <div id="message-list"></div>

        <a class="dropdown-item text-center small text-gray-500 py-3" href="#">Read More Messages</a>
    </div>
</li>

<!-- Modal -->
<!-- Selec User To Message -->
<div class="modal fade" id="selectUser" tabindex="-1" aria-labelledby="selectUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectUserLabel">Send Message To</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button> 
            </div>
            <div class="modal-body">
                <!-- DataTable to list users -->
                <table id="userTable" class="display" style="width: 100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Users will be loaded via AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Select User To Message -->
<div class="modal fade" id="sendMessage" tabindex="-1" aria-labelledby="sendMessageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMessageLabel">Send Message To</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form id="sendMessageForm">
                <div class="modal-body">
                    <!-- Hidden fields for sender and receiver IDs -->
                    <label hidden for="userSenderId">Sender</label>
                    <input hidden class="form-control" name="userSenderId" id="userSenderId">
                    <label hidden for="userReceiverId">Receiver</label>
                    <input hidden class="form-control" name="userReceiverId" id="userReceiverId">

                    <!-- Visible field for user name -->
                    <div class="mb-3">
                        <label for="userName" class="form-label">Recipient Name</label>
                        <input type="text" class="form-control" name="userName" id="userName" readonly>
                    </div>

                    <!-- Message textarea -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" name="userMessage" id="userMessage" rows="4" placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="sendMessageButton">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Conversation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="conversation">

            </div>
            <div class="modal-footer">
                <div class="input-group">
                    <input type="text" id="replyMessage" class="form-control" placeholder="Type your message..." />
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="sendReply" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


