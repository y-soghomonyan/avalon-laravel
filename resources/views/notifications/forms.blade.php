

    <div class="tab-pane container active" id="menu1">
        <div class="col-12 mt-3 px-2">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link  d-none" data-toggle="tab" href="#menu1_1">Email</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" data-toggle="tab" href="#menu2_1">Log a call</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3_1">New Task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4_1">New Event</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane container  d-none" id="menu1_1">
                    <div class="row mt-3" id="active_show_button">
                        <div class="col-12" >
                            <div class="row mt-3">
                                <div class="col-9" style="pointer-events: none;">
                                    <input required type="email" class="form-control mb-2 mr-sm-2" placeholder="Write an email..."  value="" id="" style="pointer-event:none">
                                </div>
                                <div class="col-3" style="pointer-events: none;">
                                    <input type="button" class="form-control mb-2 mr-sm-2 btn btn-primary"   value="Compose" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-none" id="activity_form">
                        <div class="col-12">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <form action="{{route('send_email')}}" method="POST" class="form-inline">
                                        @csrf
                                        <div class="col-12" >
                                            <label for="from" class="mr-sm-2 ">From</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="From" name="from" value="{{ Auth::user()->email }}" id="from"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="to" class="mr-sm-2">To</label>
                                            <input type="email" class="form-control mb-2 mr-sm-2" placeholder="To" name="to" value="" id="to"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="Bcc" class="mr-sm-2">Bcc</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Bcc" name="Bcc" value="" id="Bcc"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="Subject" class="mr-sm-2">Subject</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Subject" name="subject" value="" id="Subject"  required>
                                        </div>
                                        <div class="col-12" >
                                            <label for="" class="mr-sm-2">Content</label>
                                            <div id="editor"> </div>
                                            <textarea name="content" style="display:none" id="hiddenArea"></textarea>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="related_to" class="mr-sm-2">Account To</label>
                                            <select class="select2 select_contact form-control" name="related_to" required>
                                                <option value="0" >None</option>
                                                @foreach($accounts as $acc)
                                                    <option value="{{$acc->id}}" >{{$acc->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-info mt-3 text-white" value="Send">
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3 emails_blocks_scroll">
                                @foreach($emails as $email)
                                    <div class="row mt-3">
                                        <div class="col-3">  {{$email->subject}}</div>
                                        <div class="col-3">  {{$email->to}}</div>
                                        <div class="col-3"> <a href="{{route('delete_email',[$email->id])}}" class="btn btn-outline-danger">Delete</a></div>
                                        <div class="col-3">  {{$email->created_at}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
             
                    <div class="col-12 mt-3 " style="padding: 0px 4px" >
                        <div class=" account_info_btn collaps_show px-2 py-2" data-toggle="collapse" data-target="#upcoming" style="">
                            <svg class="slds-icon slds-icon-text-default slds-icon_x-small " focusable="false" data-key="switch" aria-hidden="true" viewBox="0 0 52 52"><g><path d="M47.6 17.8L27.1 38.5c-.6.6-1.6.6-2.2 0L4.4 17.8c-.6-.6-.6-1.6 0-2.2l2.2-2.2c.6-.6 1.6-.6 2.2 0l16.1 16.3c.6.6 1.6.6 2.2 0l16.1-16.3c.6-.6 1.6-.6 2.2 0l2.2 2.2c.5.7.5 1.6 0 2.2z"></path></g></svg>
                            <b>Upcoming & Overdue</b>
                         </div>
                        <div id="upcoming" class="show collapse">

                            <div class="row px-2 py-2 upov_max_height">
                            @if(!empty($upcoming_overdues))
                                @foreach($upcoming_overdues as $key => $upcoming_overdue)
                                <div class="col-12 <?= $key > 2 ? 'hidden-event' : ''?>">

                                      {{-- @if($$upcoming_overdue['notification'] == 'call')
                                        <div class="row mt-2">
                                          <div class="col-12">
                                                @php $log_call = (object)$upcoming_overdue;  @endphp
                                                  <div class="row">
                                                  <div class="col-1">
                                                    <div  class=" bg_c_call df_jsc_amc notification_icons">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m69.7 20h-37.6c-3.3 0-6.1 3-6.1 6v2h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v10h-2c-2.2 0-4 1.8-4 4s1.8 4 4 4h2v2c0 3 2.8 6 6.1 6h37.6c3.3 0 6.3-3 6.3-6.3v-48c0-3.3-3-5.7-6.3-5.7z m-3.6 40.3l-2.8 2.8c-0.6 0.6-1.5 1-2.3 0.9-6.6-0.4-12.8-3.4-17.2-7.7-4.4-4.4-7.4-10.6-7.7-17.2 0-0.9 0.3-1.7 0.9-2.3l2.8-2.8c1.3-1.3 3.5-1.2 4.6 0.3l2.6 3.2c0.9 1.1 0.9 2.6 0.1 3.8l-2.2 3.1c-0.3 0.4-0.3 1 0.1 1.3l4.6 5.1 5.1 4.6c0.4 0.4 0.9 0.4 1.3 0.1l3.1-2.2c1.1-0.8 2.7-0.8 3.8 0.1l3.2 2.6c1.2 0.8 1.3 3 0 4.3z"/></svg>
                                                    </div>
                                                  </div>
                                                  <div class="col-6 text-info">
                                                    {{$subject_calls[$log_call->subject] }}
                                                  </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 offset-1">You logged a call with <a href="{{ route('edit_contact', [$log_call->contact_id]) }}">{{$log_call->contacts['title']}}</a></div>
                                                    <div class="col-4">{{$log_call->created_at}}</div>
                                                    <div class="col-1">
                                                      <div class="dropdown">
                                                        <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                                                        <div class="dropdown-menu">
                                                          <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_call_{{$log_call->id}}">Edit</button> </a>
                                                          <a class="dropdown-item bg-danger text-white " href="{{route('delete_call',[$log_call->id])}}"><button class="btn text-white">Delete</button></a>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                @include('modals.edit_call')
                                          </div>
                                        </div>
                                      @endif --}}
                                      @if($upcoming_overdue['notification'] == 'event')
                                      <div class="row mb-2 mt-2">
                                        <div class="col-12">
                                              @php $event = (object)$upcoming_overdue; @endphp
                                               <div class="row text-info">
                                                <div class="col-1">
                                                  <div  class=" bg_c_event df_jsc_amc notification_icons">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m76 42h-52c-1.1 0-2 0.9-2 2v30c0 3.3 2.7 6 6 6h44c3.3 0 6-2.7 6-6v-30c0-1.1-0.9-2-2-2z m-36 28c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m14 14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m0-14c0 1.1-0.9 2-2 2h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4z m4-30h-5v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-18v-2c0-2.2-1.8-4-4-4s-4 1.8-4 4v2h-5c-3.3 0-6 2.7-6 6v2c0 1.1 0.9 2 2 2h52c1.1 0 2-0.9 2-2v-2c0-3.3-2.7-6-6-6z"/></svg>
                                                  </div>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('event', [$event->id, $url]) }}">{{$subject_events[$event->subject] }}</a>
                                                  {{-- {{$subject_events[$event->subject] }} --}}
                                                </div>
                                              </div>
                                              <div class="row">
                                                  @if(!empty($event->contacts))
                                                      <div class="col-6 offset-1">You had an event with <a href="{{ route('edit_contact', [$event->contact_id]) }}">{{$event->contacts['title']}}</a> </div>
                                                  @endif
                                                  {{--<div class="col-6 offset-1">You had an event with <a href="{{ route('edit_contact', [$event->contact_id]) }}">{{$event->contacts['title']}}</a> </div>--}}
                                                  <div class="col-4">{{$event->created_at}}</div>
                                                  <div class="col-1"><div class="dropdown">
                                                      <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                                                      <div class="dropdown-menu" x-placement="top-left">
                                                        <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_event_{{$event->id}}">Edit</button> </a>
                                                        <a class="dropdown-item bg-danger text-white" href="{{route('delete_event',[$event->id, $url])}}"><button class="btn text-white"> Delete</button></a>
                                                      
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              @include('modals.edit_event')
                                        </div>
                                      </div>
                                      @endif
                                      @if($upcoming_overdue['notification'] == 'task')
                                      <div class="row mb-2 mt-2">
                                        <div class="col-12">
                                          @php $task = (object)$upcoming_overdue; @endphp
                                          <div class="row">
                                          <div class="col-1">
                                            <div  class=" bg_c_quotes df_jsc_amc notification_icons">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="#fff" d="m46.6 23.7l-2.1-2.1c-0.6-0.6-1.5-0.6-2.1 0l-13.2 13.2-5.3-5.3c-0.6-0.6-1.5-0.6-2.1 0l-2.1 2.1c-0.6 0.6-0.6 1.5 0 2.1l7.4 7.4c0.6 0.6 1.4 0.9 2.1 0.9 0.8 0 1.5-0.3 2.1-0.9l15.3-15.3c0.5-0.5 0.5-1.5 0-2.1z m30.4 14.3h-26c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h26c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m-44 0h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m0 18h-4c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h4c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z m44 0h-32c-1.1 0-2-0.9-2-2v-4c0-1.1 0.9-2 2-2h32c1.1 0 2 0.9 2 2v4c0 1.1-0.9 2-2 2z"/></svg>    
                                            </div>
                                          </div>
                                          <div class="col-6 text-info">
                                            <a href="{{ route('task', [$task->id, $url]) }}">{{$subject_tasks[$task->subject] }}</a>
                                            {{-- {{$subject_tasks[$task->subject] }} --}}
                                          </div>
                                        </div>
                                        <div class="row">
                                            @if(!empty($event->contacts))
                                                <div class="col-6 offset-1">You logged a task with <a href="{{ route('edit_contact', [$task->contact_id]) }}">{{$task->contacts['title']}}</a> </div>
                                            @endif
                                            {{--<div class="col-6 offset-1">You logged a task with <a href="{{ route('edit_contact', [$task->contact_id]) }}">{{$task->contacts['title']}}</a></div>--}}
                                            <div class="col-4">{{$task->created_at}}</div>
                                            <div class="col-1"><div class="dropdown">
                                                <button type="button" class="btn btn-light text-muted dropdown-toggle" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="#"><button class="btn" data-toggle="modal" data-target="#edit_task_{{$task->id}}">Edit</button> </a>
                                                  <a class="dropdown-item bg-danger text-white" href="{{route('delete_task',[$task->id, $url])}}"><button class="btn text-white">Delete</button></a>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        @include('modals.edit_task')
                                        </div>
                                      </div>
                                      @endif
                                  </div>

                                @endforeach
                            @else
                                <div class="border-bottom mt-2 pt-1 px-2 pb-3">
                                    <div class="text-center">No activities to show</div>
                                    <div class="text-center">Get started by sending an email, scheduling a task, and more</div>
                                </div>
                            @endif
                            </div>
                            <div class="row">
                                <div class="df_jsc_amc">
                                    <button class="btn btn btn-outline-success upov_max_height_button">Show More</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="col-12 mt-3 px-3">
                        <div class="text-center">No past activity. Past meetings and tasks marked as done show up here</div>
                    </div> --}}
                </div>
                <div class="tab-pane container  mt-3 show active" id="menu2_1">
                    {{-- @php
                        $url = Route::currentRouteName();
                        $id =  $account->id;
                    @endphp --}}
                    <form action="{{route('add_log_call')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3">
                            <label for="" class="mr-sm-2">Subject</label>
                            <div>
                                <select class="select2 select_contact form-control" name="subject" required>
                                    <option value="1">Call</option>
                                    <option value="2">Send Letter</option>
                                    <option value="3">Send Quote</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="comment" class="mr-sm-2">Comment</label>
                            <textarea name="comments" class="form-control"  ></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mt-3">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
                <div class="tab-pane container fade" id="menu3_1">
                    <form action="{{route('add_task')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3">
                            <label for="" class="mr-sm-2">Subject</label>
                            <div>
                                <select class="select2 select_contact form-control" name="subject" required>
                                    <option value="1">Call</option>
                                    <option value="2">Send Letter</option>
                                    <option value="3">Send Quote</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Due Date</label>
                                <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="date" value="" id="" required>
                            </div>

                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ Auth::user()->first_name == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mt-3">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
                <div class="tab-pane container fade" id="menu4_1">
                    <form action="{{route('add_event')}}" method="POST" class="form-inline">
                        @csrf
                        <div class="col-12 mt-3">
                            <label for="" class="mr-sm-2">Subject</label>
                            <div>
                                <select class="select2 select_contact form-control" name="subject" required>
                                    <option value="1">Call</option>
                                    <option value="2">Email</option>
                                    <option value="3">Meeting</option>
                                    <option value="4">Send Letter/Quote</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="" class="mr-sm-2">Description</label>
                            <textarea name="description" class="form-control"  ></textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 mt-2 ">
                                <b>Start</b>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="start_date" value="" id="" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="start_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-2 ">
                                <b>End</b>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="end_date" value="" id="" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="end_time" value="" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Location</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Location" name="location" value="" id="">
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Contact</label>
                                <select class="select2 select_contact form-control" name="contact_id" required>
                                    <option value="0">None</option>
                                    @foreach($contacts as $contac)
                                        <option value="{{$contac->id}}" {{!empty($contact) && $contact->id == $contac->id ? "selected" : ""}}>{{$contac->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6  ">
                                <label for="related_to" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $acco)
                                        <option value="{{$acco->id}}" {{!empty($account) && $account->id == $acco->id ? "selected" : ""}}>{{$acco->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $compan)
                                        {{--<option value="{{$company->id}}">{{$company->name}}</option>--}}
                                        <option value="{{$compan->id}}" {{!empty($company) && $company->id == $compan->id ? "selected" : ""}}>{{$compan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info mt-3 text-white" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>


