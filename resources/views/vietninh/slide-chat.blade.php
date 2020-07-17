
            <div class="col-md-2">
                <div class="chat_customer">
                    <span>Chat với khách hàng</span>
                    <button style="background-color: #fff;border:none;width:22%;height:70px;margin-left:20px">
                        <img src="./image/Icon-ionic-ios-search.svg" />
                    </button>
                </div>
                <div class="form-chat">
                    <form method="POST" action="/home/contact">
                        @csrf
                        <div class="form-group" id="author-chat">
                            <label for="my-input">Name</label>
                            <input id="my-input" class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group" id="author-chat">
                            <label for="my-input">Phone</label>
                            <input id="my-input" class="form-control" type="text" name="phone">
                        </div>
                        <div class="form-group" id="content-chat">
                            <label for="my-input">Comment</label>
                            <textarea name="comment"></textarea>
                        </div>
                        <button type="submit" name="send">Chat</button>
                    </form>
                </div>
                <div id="data">
                    @foreach($contact as $row)
                        <div class="the_customer">
                            <img src="./image/image-Logo.png" style="max-width:60px;max-height:60px; border-radius:50%;object-fit:contain;float:left;">
                        <div id="the_customer1">
                                <h4 style="font-size: 18px;line-height:30px;"><b>{{ $row->name }}</b></h4>
                                <p>{{ $row->phone }}</p>
                                <p>{{ $row->comment }}</p>
                            </div>
                        <div id="the_customer2">
                            <span>1</span>
                            <p style="line-height:38px;">8:30AM</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

