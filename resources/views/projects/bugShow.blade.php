<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label>{{ __('Title')}} :</label>
            <p class="m-0 p-0">{{$bug->title}}</p>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label>{{ __('Priority')}} :</label>
            <p class="m-0 p-0">{{$bug->priority}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>{{ __('Description')}} :</label>
            <p class="m-0 p-0">{{$bug->description}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>{{ __('Created Date')}} :</label>
            <p class="m-0 p-0">{{$bug->created_at}}</p>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="form-group">
            <label>{{ __('Assign to')}} :</label>
            <p class="m-0 p-0">{{$bug->assignTo->name}}</p>
        </div>
    </div>
</div>
<div class="task-inner-tab">
    <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> {{__('Comments')}} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> {{__('Files')}} </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="form-group m-0">
                <form method="post" id="form-comment" data-action="{{route('bug.comment.store',[$bug->project_id,$bug->id])}}">
                    <textarea class="form-control" name="comment" placeholder="{{ __('Write message')}}" id="example-textarea" rows="3" required></textarea>
                    <div class="text-right mt-10">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="button" class="btn btn-primary">{{ __('Submit')}}</button>
                        </div>
                    </div>
                </form>
                <div class="comment-holder" id="comments">
                    @foreach($bug->comments as $comment)
                        <div class="media">
                            <div class="media-body">
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <h5 class="mt-0">{{$comment->user->name}}</h5>
                                        <p class="mb-0">{{$comment->comment}}</p>
                                    </div>
                                    <a href="#" class="btn btn-outline btn-sm red text-muted  delete-comment" data-url="{{route('bug.comment.destroy',$comment->id)}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="form-group m-0">
                <form method="post" id="form-file" enctype="multipart/form-data" data-url="{{ route('bug.comment.file.store',$bug->id) }}">
                    @csrf
                    <input type="file" class="form-control mb-2" name="file" id="file">
                    <span class="invalid-feedback" id="file-error" role="alert">
                        <strong></strong>
                    </span>
                    <div class="text-right mt-10">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="submit" class="btn btn-primary">{{ __('Upload')}}</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <ul class="col-md-12" id="comments-file">
                        @foreach($bug->bugFiles as $file)
                            <li class="media">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1 font-weight-bold"> {{$file->name}}</h6>
                                    {{$file->file_size}}
                                    <div class="comment-trash" style="float: right">
                                        <a download href="{{asset('/storage/bugs/'.$file->file)}}" class="btn btn-outline btn-sm blue-madison">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline btn-sm red text-muted delete-comment-file" data-url="{{route('bug.comment.file.destroy',[$file->id])}}">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

