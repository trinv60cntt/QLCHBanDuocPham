<div>
    <?php
    $customer_id = Session::get('khachhang_id');
    $hoKH = Session::get('hoKH');
    $tenKH = Session::get('tenKH');
    $hinhAnh = Session::get('hinhAnh');
    ?>
    <div class="flex justify-center" wire:poll="mountComponent()">
        {{-- @php dd($adminLogin) @endphp --}}
        @if (Auth::user() != null)
        @if($adminLogin->is_admin == true)
            <div class="w-4/12 px-4" wire:init>
                <div class="card card-v1">
                    <div class="card-header">
                        Khách hàng
                    </div>
                    <div class="card-body chatbox p-0">
                        <ul class="list-group list-group-flush" wire:poll="render">
                            @foreach($users as $user)
                                @php
                                    $not_seen = \App\Models\Message::where('user_id', $user->id)->where('receiver', $adminLogin->id)->where('is_seen', false)->get() ?? null
                                @endphp
                                <a href="{{ route('inbox.show', $user->id) }}" class="text-dark link">
                                    <li class="list-group-item" wire:click="getUser({{ $user->id }})" id="user_{{ $user->id }}">
                                        <img class="img-fluid avatar" src="https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png">
                                        @if($user->is_online) <i class="fa fa-circle text-green-500 online-icon"></i> @endif {{ $user->name }}
                                        @if(filled($not_seen))
                                            <div class="badge badge-success rounded">{{ $not_seen->count() }}</div>
                                        @endif
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        @endif
        <div class="w-4/6 mx-auto">
            <div class="card card-v2">
                <div class="card-header">
                    @if(isset($clicked_user)) {{ $clicked_user->name }}
                    @elseif(Auth::user() != null)
                        @if($adminLogin->is_admin == true)
                            Select a user to see the chat
                        @endif
                    @elseif($admin->is_online)
                        <i class="fa fa-circle text-green-500"></i> <span class="text-xl ml-2">Nhà Thuốc Số 2</span>
                    @else
                        Nhà Thuốc Số 2
                    @endif
                </div>
                    <div class="card-body message-box">
                        @if(!$messages)
                            No messages to show
                        @else
                            {{-- @php dd($messages) @endphp --}}
                            @if(isset($messages))
                                @foreach($messages as $message)
                                    {{-- @php dd($message->user_id); @endphp --}}
                                    <div class="single-message @if (Auth::user() != null)@if($message->user_id !== $adminLogin->id) received @else sent @endif @endif  @if($customer_id != NULL) @if($message->user_id !== $usersLogin->id) received @else sent @endif @endif">
                                        <p class="font-weight-bolder my-0">{{ $message->user->name }}</p>
                                        <p class="my-0">{{ $message->message }}</p>
                                        @if (isPhoto($message->file))
                                            <div class="w-100 my-2">
                                                <img class="img-fluid rounded" loading="lazy" style="height: 250px" src="{{ $message->file }}">
                                            </div>
                                        @elseif (isVideo($message->file))
                                            <div class="w-100 my-2">
                                                <video style="height: 250px" class="img-fluid rounded" controls>
                                                    <source src="{{ $message->file }}">
                                                </video>
                                            </div>
                                        @elseif ($message->file)
                                            <div class="w-100 my-2">
                                                <a href="{{ $message->file}}" class="bg-light p-2 rounded-pill" target="_blank"><i class="fa fa-download"></i> 
                                                    {{ $message->file_name }}
                                                </a>
                                            </div>
                                        @endif
                                        <small class="text-muted w-100">Sent <em>{{ $message->created_at }}</em></small>
                                    </div>
                                @endforeach
                            @else
                                Không có tin nhắn nào để hiển thị
                            @endif
                            @if ($adminLogin != null)
                            @if(!isset($clicked_user))
                                @if(Auth::user() != null)
                                    @if($adminLogin->is_admin == true)
                                    Click on a user to see the messages
                                    @endif
                                @endif
                            @endif
                            @endif
                        @endif
                    </div>
                {{-- @if(auth()->user()->is_admin == false) --}}


                <?php
                if($customer_id != NULL) {


              ?>
              {{-- @if($customer_id != NULL) --}}
                    <div class="card-footer">
                        <form wire:submit.prevent="SendMessage" enctype="multipart/form-data">
                            <div wire:loading wire:target='SendMessage'>
                                Sending message . . . 
                            </div>
                            <div wire:loading wire:target="file">
                                Uploading file . . .
                            </div>
                            @if($file)
                                <div class="mb-2">
                                   You have an uploaded file <button type="button" wire:click="resetFile" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Remove {{ $file->getClientOriginalName() }}</button>
                                </div>
                            @else
                                No file is uploaded.
                            @endif
                            <div class="flex">
                                <div class="w-7/12">
                                    <input wire:model="message" class="form-input input shadow-none w-full d-inline-block" placeholder="Type a message" @if(!$file) required @endif>
                                </div>
                                @if(empty($file))
                                <div class="w-1/12 flex justify-center">
                                    <button type="button" id="file-area">
                                        <label>
                                            <i class="fa fa-file-upload"></i>
                                            <input type="file" wire:model="file">
                                        </label>
                                    </button>
                                </div>
                                @endif
                                <div class="w-4/12 flex justify-center items-center">
                                    <button class="btn btn-primary inline-block w-full"><i class="far fa-paper-plane"></i> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                {{-- @endif --}}
            {{-- </div> --}}
            <?php } ?>
        </div>
    </div>
</div>
