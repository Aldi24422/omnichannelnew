<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("../includes/head.php");
    ?>
</head>

<body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <?php require_once("../includes/header.php"); ?>
        <div class="page-body-wrapper">
            <?php require_once("../includes/sidebar.php"); ?>
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Chat Whatsapp</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Chat Whatsapp</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col call-chat-sidebar col-sm-12">
                            <div class="card">
                                <div class="card-body chat-body">
                                    <div class="chat-box">
                                        <div class="chat-left-aside">
                                            <div class="media"><img class="rounded-circle user-image" src="../assets/images/user/12.png" alt="">
                                                <div class="about">
                                                    <div class="name f-w-600">Mark Jecno</div>
                                                    <div class="status">Status...</div>
                                                </div>
                                            </div>
                                            <div class="people-list" id="people-list">
                                                <div class="search">
                                                    <form class="theme-form">
                                                        <div class="mb-3">
                                                            <input class="form-control" type="text" placeholder="search"><i class="fa fa-search"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                                <ul class="list">
                                                    <!-- List of users -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col call-chat-body">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="row chat-box">
                                        <div class="col pe-0 chat-right-aside">
                                            <div class="chat">
                                                <div class="chat-header clearfix"><img class="rounded-circle" src="../assets/images/user/8.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">Kori Thomas  <span class="font-primary f-12">Typing...</span></div>
                                                        <div class="status">Last Seen 3:55 PM</div>
                                                    </div>
                                                    <ul class="list-inline float-start float-sm-end chat-menu-icons">
                                                        <li class="list-inline-item"><a href="#"><i class="icon-search"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="icon-clip"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="chat-history chat-msg-box custom-scrollbar">
                                                    <ul></ul>
                                                </div>
                                                <div class="chat-message clearfix">
                                                    <div class="row">
                                                        <div class="col-xl-12 d-flex">
                                                            <div class="smiley-box bg-primary">
                                                                <div class="picker"><img src="../assets/images/smiley.png" alt=""></div>
                                                            </div>
                                                            <div class="input-group text-box">
                                                                <input class="form-control input-txt-bx" id="message-to-send" type="text" name="message-to-send" placeholder="Type a message......">
                                                                <button class="input-group-text btn btn-primary" id="send-button" type="button">SEND</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once("../includes/footer.php"); ?>
            </div>
        </div>
    </div>
    <?php require_once("../includes/script.php"); ?>

    <script>
        async function loadChatHistory() {
            try {
                const response = await fetch("http://localhost:3000/chat-history");
                const data = await response.json();
                const chatContainer = document.querySelector(".chat-history ul");

                if (data.success) {
                    chatContainer.innerHTML = "";
                    data.data.forEach(chat => {
                        const li = document.createElement("li");
                        li.className = chat.sender === "user" ? "clearfix" : "";
                        li.innerHTML = `
                            <div class="message ${chat.sender === "user" ? "my-message" : "other-message pull-right"}">
                                <div class="message-data ${chat.sender === "user" ? "text-end" : ""}">
                                    <span class="message-data-time">${new Date(chat.timestamp).toLocaleTimeString()}</span>
                                </div>
                                ${chat.message}
                            </div>
                        `;
                        chatContainer.appendChild(li);
                    });
                }
            } catch (err) {
                console.error("Error loading chat history:", err);
            }
        }

        async function sendMessage(input) {
            try {
                const response = await fetch("http://localhost:3000/send-message", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        message: input
                    }),
                });
                const data = await response.json();

                if (data.success) {
                    loadChatHistory();
                } else {
                    console.error("Error sending message:", data.message);
                }
            } catch (err) {
                console.error("Error sending message:", err);
            }
        }

        document.querySelector("#message-to-send").addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                const input = e.target.value.trim();
                if (input) {
                    sendMessage(input);
                    e.target.value = "";
                }
            }
        });

        document.querySelector("#send-button").addEventListener("click", () => {
            const input = document.querySelector("#message-to-send").value.trim();
            if (input) {
                sendMessage(input);
                document.querySelector("#message-to-send").value = "";
            }
        });

        document.addEventListener("DOMContentLoaded", loadChatHistory);
    </script>
</body>

</html>
