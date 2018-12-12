$ ( document ).ready ( function () {
	
	/**
	 *
	 *
	 *
	 * @constructor Task
	 * @param ___TaskId
	 * @param ___TaskName
	 * @param ___TaskDescription
	 *
	 */
	function Task ( ___TaskId, ___TaskName, ___TaskDescription ) {
		
		this.___TaskId          = ___TaskId;
		this.___TaskName        = ___TaskName;
		this.___TaskDescription = ___TaskDescription;
		
	}
	
	
	
	
	
	
	
	
	
	
	/**
	 *
	 * @returns {object} New task instance, with guarantees especially for push
	 * @constructor
	 */
	
	Task.prototype.Update = function () {
		
		this.___TaskId          = this.___TaskId ? this.___TaskId : '';
		this.___TaskName        = this.___TaskName ? this.___TaskName : undefined;
		this.___TaskDescription = this.___TaskDescription ? this.___TaskDescription : '';
		
		if ( this.___TaskId === undefined ) {
			
			throw 'Task id is required'
			
		} else if ( this.___TaskName === undefined ) {
			
			throw 'Task name is required'
			
		} else {
			
			return {
				TaskId : this.___TaskId,
				TaskName : this.___TaskName,
				TaskDescription : this.___TaskDescription,
			};
			
		}
		
	};
	
	Task.prototype.New = function () {
		
		this.___TaskName        = this.___TaskName ? this.___TaskName : undefined;
		this.___TaskDescription = this.___TaskDescription ? this.___TaskDescription : undefined;
		
		if ( this.___TaskName === undefined ) {
			
			throw 'Task name is required'
			
		} else if ( this.___TaskDescription === undefined ) {
			
			throw 'Task description is required'
			
		} else {
			
			return {
				TaskName : this.___TaskName,
				TaskDescription : this.___TaskDescription,
			};
			
		}
		
	};
	
	
	
	Task.prototype.Delete = function () {
		
		this.___TaskId = this.___TaskId ? this.___TaskId : '';
		
		if ( this.___TaskId === undefined ) {
			
			throw 'Task id is required to perform delete'
			
		} else {
			
			return {
				
				TaskId : this.___TaskId,
				
			};
			
		}
		
	};
	
	
	
	var Tasks                  = [],
	    Form                   = $ ( '.taskForm' ),
	    Modal                  = $ ( '#task_modal' ),
	    TaskId,
	    TaskName,
	    TaskDescription,
	    EmptyTaskList = `
	        <li class="task-list-item text-center">
            	<div class="icon"><img src=""/></div>
            	<h3 class="empty-title">No Tasks Available</h3>
        	</li>
	    `,
	    
	    
	    /**
	     * @param i
	     * @param task
	     * @return {string} return html template
	     * @function
	     *
	     */
	    TaskListItemTemplate   = function ( i, task ) {
	    	
	    	try{
			    i = eval( i + 1)
		    }catch ( e ) {
			   
		    }
		    
		    return `
						<li class="row no-gutters task-list-item">
				            <div class="task-meta">
				                <div class="number">` + i + `</div>
				                <div class="title">
				                	<div class="name">` + task.TaskName + `</div>
				                	<div class="description">` + task.TaskDescription + `</div>
								</div>
							</div>
				            <div class="task-tools">
				                <a href="#" class="delete" id="delete_` + task.TaskId + `"></a>
				                <a href="#" class="edit" id="edit_` + task.TaskId + `"></a>
							</div>
				        </li>
					`
	    },
	    SpinnerServiceTemplate = `
        <div class="state-loader">
    		<span></span>
   		 	<span></span>
		</div>
    `;
	
	
	
	
	
	
	
	
	
	
	function showSpinnerInContainer ( container ) {
	
	
	
	}
	
	
	
	
	
	
	
	
	
	
	function getTasks () {
		
		$.post ( "Task.get.php", function ( data ) {
			
			Tasks = data;
			
			console.log ( Tasks );
			
			if ( Tasks.length > 0 ) {
				
				var listItemlistItem = '';
				
				$.each ( Tasks, function ( i, task ) {
					
					listItemlistItem += TaskListItemTemplate ( i, task );
					
				} );
				
				$ ( '.task_list' ).html ( listItemlistItem );
				
			} else {
				
				$ ( '.task_list' ).html ( EmptyTaskList );
			
			}
			
		}, "json" );
		
	}
	
	
	
	
	
	
	
	
	
	
	getTasks ();
	
	
	
	
	
	$ ( document ).on ( 'click', '[id^="delete"]', function ( e ) {
		
		var id = $ ( this ).attr ( 'id' ); // remove delete_
		TaskId = id.replace("delete_", "");
		
		let ____task = new Task ( TaskId );
		
		
		$.post ( "Task.delete.php", ____task.Delete () ).done ( function ( response ) {
			
			getTasks ();
			
		} )
		
	} );
	
	
	
	
	$ ( document ).on ( 'click', '[id^="edit"]', function ( e ) {
		
		var id = $ ( this ).attr ( 'id' );
		TaskId = id.replace("edit_", "");
		
		/**
		 *
		 * @type {*} get current task by id
		 *
		 *
		 */
		
		var currentTask = Tasks.find(obj => {
			return obj.TaskId === TaskId
		});
		
		$ ( Modal ).modal ( 'show' );
		
		$ ( Modal ).on ( 'shown.bs.modal', function ( e ) {
			
			$ ( Form ).find ( '.TaskId' ).val ( TaskId );
			$ ( Form ).find ( '.TaskName' ).val ( currentTask.TaskName );
			$ ( Form ).find ( '.TaskDescription' ).val ( currentTask.TaskDescription );
			
			getTasks ();
			
		} );
		
	} );
	
	
	
	
	
	
	
	$ ( '#saveTask' ).bind ( 'click', function () {
		
		TaskId          = $ ( Form ).find ( '.TaskId' ).val ();
		TaskName        = $ ( Form ).find ( '.TaskName' ).val ();
		TaskDescription = $ ( Form ).find ( '.TaskDescription' ).val ();
		
		if ( TaskId ) {
			
			let ____task = new Task ( TaskId, TaskName, TaskDescription );
			
			console.log ( ____task.Update () );
			
			$.post ( "Task.update.php", ____task.Update () ).done ( function ( response ) {
				
				console.log ( response );
				
				$ ( Modal ).modal ( 'hide' );
				
			} );
			
		} else {
			
			let ____task = new Task ( null, TaskName, TaskDescription );
			
			console.log ( ____task.New () );
			
			$.post ( "Task.new.php", ____task.New () ).done ( function ( response ) {
				
				$ ( Modal ).modal ( 'hide' );
				
				getTasks ();
				
			} )
			
		}
		
	} );
	
	
	
	$ ( Modal ).on ( 'hide.bs.modal', function ( e ) {
		
		$ ( Form ).find ( '.TaskId' ).val ( '' );
		$ ( Form ).find ( '.TaskName' ).val ( '' );
		$ ( Form ).find ( '.TaskDescription' ).val ( '' );
		
	} ).on ( 'hidden.bs.modal', function ( e ) {
		
		$ ( Form ).find ( '.TaskId' ).val ( '' );
		$ ( Form ).find ( '.TaskName' ).val ( '' );
		$ ( Form ).find ( '.TaskDescription' ).val ( '' );
		
	} );
	
	
} );

