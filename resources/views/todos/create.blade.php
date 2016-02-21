@extends('app')

@section('content')
   <div class="page-header">
    	<h1 id="timeline">Add Todo</h1>
   </div>
   {!! Form::open(['url' => '/todos/store', 'class' => 'form-horizontal']) !!}
        {!! csrf_field() !!}
		<fieldset>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <ul>
            	<li>
            		<div class="container" style="margin-top: 30px;">
            			<div class="row form-group">
            				<div
            					class="col-xs-12 col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8">
            					<div class="panel panel-default">
            						<div class="panel-heading">
            							<i>Tags</i> - <input type="text" name="tags" 
            								value="<?php if(old('tags')) { echo old('tags'); } else if(isset($tags)) { echo $tags; } ?>"
            								data-role="tagsinput" readonly="readonly" />
            						</div>
            
            						<div class="panel-image">
            							<table>
            								<tr>
            									<td style="padding: 15px"><label>To do</label></td>
            									<td colspan="4"><input id="ToDo" name="todo" type="text"
            									    value="<?php if(old('todo')) { echo old('todo'); } else if(isset($todo)) { echo $todo; } ?>"
            										placeholder="To Do" class="form-control input-md"
            										required=""></td>
            
            								</tr>
            								<tr>
            									<td style="padding: 15px"><label>Location </label></td>
            									<td colspan="4"><textarea class="form-control custom-control" name="location"
            									        value="<?php if(old('location')) { echo old('location'); } else if(isset($location)) { echo $location; } ?>"
            											rows="3" style="resize: none"></textarea></td>
            
            								</tr>
            								<tr>
            									<td style="padding: 15px"><label>Start Date</label></td>
            									<td><input id="date" name="todo_time" type="datetime-local"
            									    value="<?php if(old('todo_time')) { echo old('todo_time'); } else if(isset($todo_time)) { echo $todo_time; } ?>"
            										class="form-control input-md" required=""></td>
                                                <td style="padding: 15px">
            										<div class="radio">
            											<label><input type="checkbox" name="is_price" value="1">Is price?</label>
            										</div>
            									</td>
            									<td><input id="benefit" name="benefit" type="text"
            									    value="<?php if(old('benefit')) { echo old('benefit'); } else if(isset($benefit)) { echo $benefit; } ?>"
            										placeholder="Benefit" class="form-control input-md"
            										required="">
            									</td>
            
            								</tr>
            
            							</table>
            						</div>
            
            						<div class="panel-footer clearfix">
            							<button id="submit" name="submit" class="btn btn-primary">Save</button>
            							<button id="delete" name="delete" class="btn btn-danger">Cancel</button>
            							<span class="toggler fa fa-chevron-down pull-right"></span>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
            
            	</li>
            </ul>
        </fieldset>
	{!! Form::close() !!}
@stop