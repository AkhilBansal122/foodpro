@extends('layouts.admin.header') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
   @extends('layouts.yajradatable') 

  <style>
    .error{
     color: #FF0000; 
    }
  </style>
@section('content')
<div class="content-body message-body">
            <!-- row -->
			<div class="container">
				<div class="row">
					<div class="col-xl-4">
						<div class="card chat-box h-auto">
							<div class="card-header border-0 px-4">
		
								
									<!-- Button trigger modal -->
									

								
							</div>
							<div class="card-body dlab-scroll pt-0" id="chat-sidebar">
								<span class="font-w600 fs-18">Your Chat</span>
								<ul>
									<li class="chat-bx">
										<div class="chat-img">
											<img src="images/chat-img/pic-1.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #1</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<span class="badge badge-primary">2</span>
										</div>
										
									</li>
									<li class="chat-bx">
										<div class="chat-img">
											<img src="images/chat-img/pic-2.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #2</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M8.2632 21.7501C7.8747 21.7501 7.4907 21.6008 7.1997 21.3098L2.68995 16.8001C2.1027 16.2136 2.1027 15.2611 2.68995 14.6746C3.2772 14.0873 4.2282 14.0873 4.81545 14.6746L8.4417 18.3008L19.3954 10.7821C20.0794 10.3126 21.0154 10.4866 21.4849 11.1706C21.9552 11.8553 21.7812 12.7906 21.0964 13.2608L9.1137 21.4861C8.85495 21.6631 8.5587 21.7501 8.2632 21.7501Z" fill="#2D9CDB"/>
											<path d="M8.2632 13.4821C7.8747 13.4821 7.4907 13.3328 7.1997 13.0418L2.68995 8.53207C2.1027 7.94482 2.1027 6.99307 2.68995 6.40657C3.2772 5.81932 4.2282 5.81932 4.81545 6.40657L8.4417 10.0328L19.3954 2.51407C20.0794 2.04457 21.0154 2.21857 21.4849 2.90257C21.9552 3.58732 21.7812 4.52257 21.0964 4.99282L9.1137 13.2188C8.85495 13.3958 8.5587 13.4821 8.2632 13.4821Z" fill="#2D9CDB"/>
											</svg>
										</div>
									</li>
									<li class="chat-bx">
										<div class="chat-img active">
											<img src="images/chat-img/pic-3.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #3</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<span class="badge badge-primary">2</span>
										</div>
										
									</li>
									<li class="chat-bx">
										<div class="chat-img">
											<img src="images/chat-img/pic-4.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #4</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<span class="badge badge-primary">2</span>
										</div>
										
									</li>
									<li class="chat-bx">
										<div class="chat-img">
											<img src="images/chat-img/pic-5.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #5</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<span class="badge badge-primary">2</span>
										</div>
									</li>
									<li class="chat-bx">
										<div class="chat-img">
											<img src="images/chat-img/pic-5.jpg" alt="">
										</div>
										<div class="mid-info">
											<h4 class="name mb-2">Driver #6</h4>
											<span>Lorem ipsum dolor sit amet...</span>
										</div>
										<div class="right-info">
											<p class="mb-2">12:45 PM</p>
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M8.2632 21.7501C7.8747 21.7501 7.4907 21.6008 7.1997 21.3098L2.68995 16.8001C2.1027 16.2136 2.1027 15.2611 2.68995 14.6746C3.2772 14.0873 4.2282 14.0873 4.81545 14.6746L8.4417 18.3008L19.3954 10.7821C20.0794 10.3126 21.0154 10.4866 21.4849 11.1706C21.9552 11.8553 21.7812 12.7906 21.0964 13.2608L9.1137 21.4861C8.85495 21.6631 8.5587 21.7501 8.2632 21.7501Z" fill="#2D9CDB"/>
											<path d="M8.2632 13.4821C7.8747 13.4821 7.4907 13.3328 7.1997 13.0418L2.68995 8.53207C2.1027 7.94482 2.1027 6.99307 2.68995 6.40657C3.2772 5.81932 4.2282 5.81932 4.81545 6.40657L8.4417 10.0328L19.3954 2.51407C20.0794 2.04457 21.0154 2.21857 21.4849 2.90257C21.9552 3.58732 21.7812 4.52257 21.0964 4.99282L9.1137 13.2188C8.85495 13.3958 8.5587 13.4821 8.2632 13.4821Z" fill="#2D9CDB"/>
											</svg>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 chat-mid-area">
						<div class="card h-auto">
							<div class="card-header d-block">
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center chat-media">
										<img src="images/chat-img/pic-1.jpg" alt="">
										<div class="chat-media-content">
											<h4 class="mb-0">Driver #2</h4>
											<ul class="d-flex align-items-center">
												<li><svg class="me-2" width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect width="16" height="16" rx="4" fill="#1FBF75"/>
												</svg>
												</li>
												<li><span class=" mb-0">Online</span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="chat-box-area dlab-scroll" id="chartBox">
									<div class="media mt-0">
										<div class="message-received w-auto mb-2">
											<h6 class="mb-3">Driver</h6>
											<h6 class="d-chat font-w400">Hello !</h6>
										</div>
									</div>
									<div class="media mt-0 d-block justify-content-start align-items-start">
										 <div class="message-received d-flex justify-content-start">
											
											<h6 class="d-chat font-w400">Your order according to application yes?</h6>
										</div>
										<span class=" media style-1">12:45 PM</span>
									</div>
									
										<div class="media mb-2 justify-content-end align-items-end">
											<h6>You</h6>
										</div>
										<div class="media mb-3 justify-content-end align-items-end">
											<div class="message-sent">
												<h6 class="d-chat mb-0">Hello</h6>
											</div>
										</div>
									
									<div class="media mb-4 justify-content-end align-items-end">
										<div class="message-sent d-flex justify-content-end">
											<div>
												<h6 class="d-chat">Yes, my order according to 
													application. Thank you</h6>
												<span class="mb-0 me-auto message-span">12:45 PM</span>
											</div>
											
										</div>
									</div>
								</div>
								<div class="type-massage">
									 <div class="input-group">
										<textarea class="form-control" placeholder="Message..."></textarea>
										<div class="input-group-append d-flex align-items-center">
											<div class="btn share-btn">
												<input type="file" id="file-input">
												<label for="file-input">
													<a href="javascript:void(0);"><i class="fa fa-paperclip fa-2x"></i></a>
													<span></span>
												</label>
							 
											</div>
											<button type="button" class="btn btn-primary text-white"><span>Send</span>
												<svg class="ms-sm-2 ms-0" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 6.46222V8.88889C4.5 9.44111 4.052 9.88911 3.5 9.88911C2.948 9.88911 2.5 9.44111 2.5 8.88889V5C2.5 4.67022 2.663 4.36066 2.935 4.17478C3.208 3.98811 3.555 3.94844 3.862 4.06822L21.862 11.0682C22.247 11.2176 22.5 11.5878 22.5 12C22.5 12.4122 22.247 12.7824 21.862 12.9318L3.862 19.9318C3.555 20.0516 3.208 20.0119 2.935 19.8252C2.663 19.6393 2.5 19.3298 2.5 19C2.5 19 2.5 16.0686 2.5 13.9997C2.5 12.343 3.843 10.9998 5.5 10.9998H10.5C11.052 10.9998 11.5 11.4478 11.5 12C11.5 12.5522 11.052 13.0002 10.5 13.0002C10.5 13.0002 7.569 13.0002 5.5 13.0002C4.948 13.0002 4.5 13.4474 4.5 13.9997V17.5378L18.741 12L4.5 6.46222Z" fill="white"/>
												</svg>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	


@endsection

	<script>
		$('document').ready(function(){
  
  var $file = $('#file-input'),
      $label = $file.next('label'),
      $labelText = $label.find('span'),
      $labelRemove = $('a.remove'),
      labelDefault = $labelText.text();
  
  // on file change
  $file.on('change', function(event){
    var fileName = $file.val().split( '\\' ).pop();
		if( fileName ){
      console.log($file)
			$labelText.text(fileName);
      $labelRemove.show();
    }else{
			$labelText.text(labelDefault);
      $labelRemove.hide();
    }
  });
  
  // Remove file   
  $labelRemove.on('click', function(event){
    $file.val("");
    $labelText.text(labelDefault);
    $labelRemove.hide();
    console.log($file)
  });
})
	</script>
	
	<script>
	$(function () {
  $('#chat__form').on('submit', function(e) {
    e.preventDefault();
    var message = $('#text-message').val();
    $('#text-message').val('');
    var date = new Date().toJSON().slice(0,10).replace(/-/g,'https://fooddesk.dexignlab.com/');
    $('.chat-mid-area').append('<div class="message-received"><div class="date">' + date + '</div><div>' + message + '</div></div>')
  })
});
	
	</script>
