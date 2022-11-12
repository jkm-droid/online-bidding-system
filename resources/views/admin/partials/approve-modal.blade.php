@if($member->is_approved == 0)
    <td>
    <span class="badge badge-danger"><i class="fa fa-times-circle"></i></span>
    </td>
    @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
        <td>
            <a href="#" data-toggle="modal" data-target="#approveMemberModal{{$member->id}}">Approve</a>
        </td>

        <!-- Approve-Decline Contributions Modal-->
        <div class="modal fade" id="approveMemberModal{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Do you really want to approve this member?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Approve" below if you are ready to approve.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form action="{{ route('admin.member.approve', $member->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="btn btn-primary" type="submit" name="Approve" value="Approve">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endif

@else
    <td>
        <span class="badge badge-success"><i class="fa fa-times-circle"></i></span>
    </td>
    @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
        <td>
            <a href="#" data-toggle="modal" data-target="#declineMemberModal{{$member->id}}">Decline</a>
        </td>

        <!-- Approve-Decline Contributions Modal-->
        <div class="modal fade" id="declineMemberModal{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Do you really want to decline this member?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Approve" below if you are ready to decline.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <form action="{{ route('admin.member.approve', $member->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input class="btn btn-primary" type="submit" name="Decline" value="Decline">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endif

@endif
