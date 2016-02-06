@extends('pages.layout.master')
@section('title', $user->userName().'\'s Profile')
@section('title-info', 'Member of SavjiKitchen')
@section('content')
@parent

<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $user->userImage() }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $user->userName() }}</h3>
                    <p class="text-muted text-center">Member Since {{ $user->getSinceDate() }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Followers</b> <a href="{{ url('followers/F/'.$user->id) }}" class="pull-right badge bg-orange" id="following_count">{{ count($user->followers) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a href="{{ url('followers/I/'.$user->id) }}" class="pull-right  badge bg-blue">{{ count($user->following) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Recipes</b> <a href="{{ url('my_recipe?userId='.$user->id) }}" class="pull-right badge bg-green">{{ count($user->myRecipes()) }}</a>
                        </li>
                    </ul>
                    @if($user->id != Auth::user()->id)    

                    @if(count($user->followers)==0)
                    <a href="javascript:void(0)" id="followBtn" onclick="follow({{ $user->id }});" class="btn btn-primary btn-block">
                        <b><i class="fa fa-hand-o-up"></i> Follow</b>
                    </a>
                    @else
                        @foreach($user->followers as $follower)
                        @if($follower->user_id == Auth::user()->id && $follower->following_id == $user->id)
                        <a href="javascript:void(0)" id="followBtn" onclick="follow({{ $user->id }});" class="btn btn-success btn-block">
                            <b><i class="fa fa-hand-o-right"></i> Following</b>
                        </a>
                        @endif
                        @endforeach
                    @endif
                    </a>
                    @endif
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-user margin-r-5"></i> Gender</strong>
                    <p class="text-muted">{{ ucfirst($user->gender) }}</p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i>  Contact</strong>
                    <p class="text-muted">
                        {{ $user->contact }}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                    <p class="text-muted">{{ $user->location() }}</p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> About me</strong>
                    <p> {{ $user->about }}</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            @if(count($activities)==0)
                            <h4 class="text-center">No Activities yet</h4>
                            @endif
                            @foreach ($activities as $activity)

                            @if($activity->action_type == 'R')
                            <li>
                                <i class="fa fa-plus bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time" data-toggle="tooltip" title="" data-original-title="{{ $activity->postedDate() }}"><i class="fa fa-clock-o"></i> {{ $activity->time_ago() }}</span>
                                    <h3 class="timeline-header"><a href="#">
                                            <a href="{{ url('profile/'.$activity->user->id) }}">
                                                @if($activity->user->id == Auth::user()->id)
                                                You
                                                @else
                                                {{ $activity->user->userName() }}
                                                @endif
                                            </a> added a new recipe</h3>
                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="{{ $activity->recipes->recipeImage() }}" class=" img-responsive"/>
                                                <a href="{{ url('view_recipe/'.$activity->recipes->id) }}" class="btn btn-primary btn-xs margin-top-10">Read more</a>
                                            </div>
                                            <div class="col-md-9">
                                                <h4 class="margin-top-0">{{ $activity->recipes->recipeName() }}</h4>
                                                <p class="margin-top-0">{{ $activity->recipes->catagoryNames(60) }}</p>
                                                <p>{{ str_limit($activity->recipes->description,120,'...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @elseif($activity->action_type == 'L')
                            <li>
                                <i class="fa fa-thumbs-o-up bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time" data-toggle="tooltip" title="" data-original-title="{{ $activity->postedDate() }}"><i class="fa fa-clock-o"></i> {{ $activity->time_ago() }}</span>
                                    <h3 class="timeline-header no-border">
                                        <a href="{{ url('profile/'.$activity->user->id) }}">
                                            @if($activity->user->id == Auth::user()->id)
                                            You
                                            @else
                                            {{ $activity->user->userName() }}
                                            @endif
                                        </a> likes 
                                        @if($activity->recipes->user->id == Auth::user()->id)
                                        your
                                        @elseif($activity->recipes->user->id == $activity->action_by)
                                        this
                                        @elseif($activity->recipes->user->id != $activity->action_by)
                                        <a href="{{ url('profile/'.$activity->recipes->user->id) }}">{{ $activity->recipes->user->userName() }}'s</a>
                                        @endif
                                        posted recipe <a href="{{ url('view_recipe/'.$activity->recipes->id) }}">{{ $activity->recipes->recipeName() }}
                                        </a>
                                    </h3>
                                </div>
                            </li>
                            @elseif($activity->action_type == 'C')
                            <li>
                                <i class="fa fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time" data-toggle="tooltip" title="" data-original-title="{{ $activity->postedDate() }}"><i class="fa fa-clock-o"></i> {{ $activity->time_ago() }}</span>
                                    <h3 class="timeline-header no-border">
                                        <a href="{{ url('profile/'.$activity->user->id) }}">
                                            @if($activity->user->id == Auth::user()->id)
                                            You
                                            @else
                                            {{ $activity->user->userName() }}
                                            @endif
                                        </a> commented on  
                                        @if($activity->recipes->user->id == Auth::user()->id)
                                        your posted 
                                        @elseif($activity->recipes->user->id == $activity->action_by)
                                        this
                                        @elseif($activity->recipes->user->id != $activity->action_by)
                                        <a href="{{ url('profile/'.$activity->recipes->user->id) }}">{{ $activity->recipes->user->userName() }}'s</a> posted
                                        @endif
                                        recipe <a href="{{ url('view_recipe/'.$activity->recipes->id) }}">{{ $activity->recipes->recipeName() }}
                                        </a>
                                    </h3>
                                    <div class="timeline-body">
                                        {{ str_limit($activity->comment,150,'...') }}
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="javascript:void(0)" onclick="comments({{ $activity->recipes->id }})" class="btn btn-warning btn-flat btn-xs">View all</a>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li>
                                <i class="fa fa-hand-o-right bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time" data-toggle="tooltip" title="" data-original-title="{{ $activity->postedDate() }}"><i class="fa fa-clock-o"></i> {{ $activity->time_ago() }}</span>
                                    <h3 class="timeline-header no-border">
                                        <a href="{{ url('profile/'.$activity->user->id) }}">
                                            @if($activity->user->id == Auth::user()->id)
                                            You
                                            @else
                                            {{ $activity->user->userName() }}
                                            @endif
                                        </a> started following 
                                        <a href="{{ url('profile/'.$activity->user_id) }}">
                                            @if($activity->user_id == Auth::user()->id)
                                            You
                                            @else
                                            {{ $activity->following() }}
                                            @endif
                                        </a>
                                    </h3>

                                </div>
                            </li>
                            @endif
                            @endforeach

                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>

                        <?php echo $activities->appends(['userId' => $user->id])->render(); ?>
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section>
@stop

@section('include_js')
<script type="text/javascript" src="{{ URL::asset('plugins/custom/allInOne.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('plugins/custom/viewRecipe.js') }}"></script>
@stop