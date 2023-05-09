@include('admin.layout.header')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script type="text/javascript" src='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js'></script>
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css' />
    <link media="screen" rel="stylesheet" href='https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.css' />

<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                @include('flash-message')
							
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Customer Query</li>
							</ol>
						</nav>
					</div>
				</div>

                        <div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered data-table" style="width:100%">
                                    <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th width="100px">Action</th>
                                            </tr>
                                        </thead>
										                    <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->subject }}</td>
                                            <td>{{ $user->message }}</td>
                                            <td><button type="button" class="" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#exampleModal"
                                              data-bs-id="{{$user->id}}"
                                             data-bs-whatever="@mdo" 
                                             style="width:50px; height: 50px; background-color: blue; border: none;">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-reply" viewBox="0 0 16 16">
                                                     <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"/>
                                                </svg>
                                            </button>
                                            </td>
                                            </tr>
                                            @endforeach
										</tbody>
										
									</table>
								</div>
							</div>
						</div>
				<!--end row-->
			</div>
		</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action ="{{route('manager/send-oder-mail')}}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Subject:</label>
            <input type="text" class="form-control" id="recipient-name">
            <input type="test" name="record_id" id="record_id"/>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" name="reply" id="message-text"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="Submit" class="btn btn-primary" value="Send Submit"/>
      </div>
       </form>
     
    </div>
  </div>
</div>
<script>
const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget
  const recipient = button.getAttribute('data-bs-whatever')

const user_id= button.getAttribute('data-bs-id');
$("#record_id").val(user_id);
  const modalTitle = exampleModal.querySelector('.modal-title')
  const modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = `New message to ${recipient}`
  modalBodyInput.value = recipient
})
</script>
<script type="text/javascript">
  $(function () {

        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength:10,
        retrieve:true,
        ajax: {
          type:"POST",
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('manager.customquery.data') }}",
            data: function (d) {
                d.search = $('input[type="search"]').val(),
                d.search_key = $('.searchRestaurentName').val()
               
            },
        },
        columns: [
            {mData: 'id',
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
            {data:'name'},
            {data:'email'},
            {data: 'subject'},
            {data: 'message'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@include('admin.layout.footer')
