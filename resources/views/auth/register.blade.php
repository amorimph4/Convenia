
{{ csrf_field() }}

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="@{{ User.name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="@{{ User.email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-md-4">Cargo</label>

                <div class="col-md-6" >
                    <select id="input-office" required="true" class="form-control"  name="office_id">
                        
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label col-md-4">Grupo</label>

                <div class="col-md-6">
                    <select id="input-group" required="true" class="form-control"  name="group_id">
                        
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label col-md-4">Confirme Médico</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="checkbox" value="1"  name="is_doctor">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

