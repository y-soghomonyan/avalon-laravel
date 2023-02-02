<div class="modal " id="edit_event_{{$event->id}}">
    <div class="modal-dialog mt-5 modal-xl">
        <div class="modal-content">
            <div class="">
                <div class="text-end pt-3 px-3">
                    <button type="button"  class="btn-close text- close" data-dismiss="modal"></button>
                </div>
                <h3 class="modal-title text-center">Edit Event</h3>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="{{route('edit_event', [$event->id])}}" method="POST">
                    @csrf
                    <div class="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="bg-light p-3 h6">Calendar Details</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Subject</label>
                                    <div>
                                        @php
                                        $subject_options = [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'];
                                        @endphp
                                        <select class="select2 select_contact form-control" name="subject" required>
                                            @foreach($subject_options as $key => $subject_option)
                                                <option value="{{$key}}" {{$event->subject == $key? "selected" : ""}}>{{$subject_option}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Assigned To</label>
                                <div>
                                    <select class="select2 select_contact form-control" name="assigned_to" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$event->user_id == $user->id? "selected" : ""}}>{{$user->email}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Location</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="" name="location" value="{{$event->location}}" id="">
                            </div>
                            <div class="col-6  ">
                                <label for="contact_id" class="mr-sm-2">Company</label>
                                <select class="select2 select_contact form-control" name="company_id" required>
                                    <option value="0">None</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class=" mt-2">
                          
                            <div class="col-6 ">
                                <b>Start</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="start_date" value="{{ substr($event->start_date, 0, strpos($event->start_date, ' ')) }}" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="start_time" value="{{ $event->start_time}}" id="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <b>End</b> 
                                <div class="row">
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2"> Date</label>
                                        <input type="date" class="form-control mb-2 mr-sm-2" placeholder="" name="end_date" value="{{ substr($event->end_date, 0, strpos($event->end_date, ' ')) }}" id="" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="mr-sm-2">Time</label>
                                        <input type="time" class="form-control mb-2 mr-sm-2" placeholder="" name="end_time" value="{{ $event->end_time}}" id="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div>
                                    <input type="checkbox" class="form-check-input"  name="full_day_event"
                                    {{ $event->full_day_event?"checked" :""}} id="full_day_event" >
                                    <label for="full_day_event" class="mr-sm-2">All-Day Event</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Type</label>
                                <div>
                                    @php
                                    $typies = [1 => 'Call', 2 => 'Email', 3 => 'Meeting',  4 => 'Other'];
                                    @endphp
                                    <select class="select2 select_contact form-control" name="type" required>
                                        @foreach($typies as $key => $type)
                                            <option value="{{$key}}" {{$event->type == $key? "selected" : ""}}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="" class="mr-sm-2">Description</label>
                                <textarea name="description" id="" cols="20" rows="5" class="form-control">{{$event->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Related To</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="" class="mr-sm-2">Contact</label>
                                    <div>
                                        <select class="select2 select_emails form-control" name="contact_id">
                                            @foreach($contacts as $contact)
                                                <option value="{{$contact->id}}" {{$contact->id == $event->contact_id ? "selected" : "" }} >{{$contact->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="" class="mr-sm-2">Account To</label>
                                <select class="select2 select_contact form-control" name="related_to" required>
                                    <option value="0" >None</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$event->related_to == $account->id? "selected" : ""}}>{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6">Other Information</div>
                        </div>
                        <div class="row mt2">
                            <div class="col-6">
                                <div>
                                    <label for="reminder_set_event" class="mr-sm-2">Reminder Set</label>
                                    <input type="checkbox" class="form-check-input"  name="reminder_set"
                                     {{ $event->reminder_set?"checked" :""}} id="reminder_set_event"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 mt-2">
                            <div class="bg-light p-3 h6"> System Information</div>
                        </div>
                        <div class=" mt-2 pt-1 px-2 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div> Created By: {{ Auth::user()->first_name }}. {{$event->created_at}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border-bottom mt-2 pt-1 px-2">
                                        <div>Last Modified By: {{ Auth::user()->first_name }}. {{$event->updated_at}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>