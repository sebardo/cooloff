/**
 * @class Upload
 * @constructor
 */
thaira.uploads.Upload = function (divId, id, manager) {
	this._element = $(divId);
	this._id = id;
	this._manager = manager;

	this._titleNode = this._element.down('div.title');

	var moveLeft = this._element.down('div.buttons').down();
	moveLeft.observe('click', this.onMoveLeftClick.bindAsEventListener(this));

	var edit = moveLeft.next();
	edit.observe('click', this.onEditClick.bindAsEventListener(this));
	if (this._manager.getFields().size() == 0) {
		edit.hide();
	}

	var remove = edit.next();
	remove.observe('click', this.onRemoveClick.bindAsEventListener(this));

	var moveRight = remove.next();
	moveRight.observe('click', this.onMoveRightClick.bindAsEventListener(this));
}

/**
 * @class Upload
 */
thaira.uploads.Upload.prototype = {
	/*
	 * Properties
	 */

	_element : null,
	_titleNode : null,
	_id : 0,
	_thumbUrl : '',
	_prev : null,
	_next : null,
	_manager : null,

	/*
	 * Methods
	 */

	getElement : function () {
		return this._element;
	},

	moveLeft : function () {
		var e1 = this._prev.getElement();
		var e2 = this._element;
		e1.up().insertBefore(e2, e1);

		var prev = this._prev._prev;
		this._prev._prev = this;
		this._prev._next = this._next;
		this._next = this._prev;
		this._prev = prev;

		if (this._prev) {
			this._prev._next = this;
		}
		if (this._next._next) {
			this._next._next._prev = this._next;
		}
	},

	moveRight : function () {
		var e1 = this._element;
		var e2 = this._next.getElement();
		e1.up().insertBefore(e2, e1);

		// A <-> B <-> C <-> D (We are B)
		// A -> C
		if (this._prev) {
			this._prev._next = this._next;
		}
		// A <- C
		this._next._prev = this._prev;
		// C -> B
		var next = this._next._next;
		this._next._next = this;
		// C <- B
		this._prev = this._next;
		// B -> D
		this._next = next;
		// B <- D
		if (this._next) {
			this._next._prev = this;
		}
	},

	onMoveLeftClick : function (e) {
		if (! this._prev) {
			return;
		}

		var t = this;
		var options = {
			parameters : {
				uid : this._manager.getUid(),
				srcId : this._id,
				dstId : this._prev._id
			},
			onComplete : function (transport, json) {
				if (json.result) {
					t.moveLeft();
				} else {
					alert('Error: ' + json.message);
				}
			}
		};

		new Ajax.Request(this._manager.getActionsUrl() + '/move', options);
	},

	onMoveRightClick : function (e) {
		if (! this._next) {
			return;
		}

		var t = this;
		var options = {
			parameters : {
				uid : this._manager.getUid(),
				srcId : this._id,
				dstId : this._next._id
			},
			onComplete : function (transport, json) {
				if (json.result) {
					t.moveRight();
				} else {
					alert('Error: ' + json.message);
				}
			}
		};

		new Ajax.Request(this._manager.getActionsUrl() + '/move', options);
	},

	onEditClick : function (e) {
		// alert(this._manager.getUid());
		pos = Position.cumulativeOffset(this._element);
		var e = new thaira.uploads.Editor(this._manager.getUid(), this._id, pos,
				this._manager.getConfig());
		var t = this;
		e.onSaved = function () {
			t._titleNode.update(e.getTitle());
		}
	},

	onRemoveClick : function (e) {
		var msg = this._manager.getConfig().i18n.uploadRemoveAlertMsg;
		if (! confirm(msg)) {
			return;
		}

		var t = this;
		var options = {
			parameters : {
				uid : this._manager.getUid(),
				id : this._id
			},
			onComplete : function (transport, json) {
				if (json.result) {
					t._manager.removeUpload(t);
				} else {
					alert('Error: ' + json.message);
				}
			}
		};

		new Ajax.Request(this._manager.getActionsUrl() + '/remove', options);
	},

	remove : function () {
		this._element.remove();
		if (this._prev) {
			this._prev._next = this._next;
		}
		if (this._next) {
			this._next._prev = this._prev;
		}
	},

	setPrev : function (prev) {
		this._prev = prev;
		prev._next = this;
	}
}