/**
 * @class UploadsManager
 * @constructor
 */
thaira.uploads.UploadsManager = function (config) {
	this._uploadsNode = $('uploads' + config.uid);
	this._uploads = [];
	this._actionsUrl = config.actionsUrl;
	this._fields = config.editorFields;
	this._config = config;
}

/**
 * @class UploadsManager
 */
thaira.uploads.UploadsManager.prototype = {
	/*
	 * Properties
	 */

	_uploadsNode : null,
	_uploads : [],
	_count : 0,
	_actionsUrl : null,
	_fields : null,
	_config : null,

	/*
	 * Methods
	 */

	createAndAdd : function (divId, id) {
		var last = this._uploads.last();
		var u = new thaira.uploads.Upload(divId, id, this);
		if (last) {
			u.setPrev(last);
		}
		this._uploads.push(u);
		this._count++;
		return u;
	},

	generateAndAdd : function (title, id, imgSrc) {
		var divId = 'upload' + this._uid + this._count;

		new Insertion.Bottom(this._uploadsNode,
				this._config.uploadTemplate.evaluate({id : divId, title : title,
					imgSrc : imgSrc}));

		this.createAndAdd(divId, id);
	},

	getActionsUrl : function () {
		return this._actionsUrl;
	},

	getConfig : function () {
		return this._config;
	},

	getCount : function () {
		return this._count;
	},

	getFields : function () {
		return this._fields;
	},

	getUid : function () {
		return this._config.uid;
	},

	removeUpload : function (upload) {
		this._count--;
		upload.remove();
	}
}