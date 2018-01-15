/**
 * @class Uploader
 * @constructor
 */
thaira.uploads.Uploader = function (uid, divId, config) {
	this._element = $(divId);
	this._element.down(0).observe('submit', this.onSubmit.bindAsEventListener(this))
	this._element.down(3).observe('click', this.onUploadClick.bindAsEventListener(this));
	this._element.down(4).observe('click', this.onCancelClick.bindAsEventListener(this));
	this._uploadsManager = window['uploadsManager' + uid];
	this._uploadersNode = $('uploaders' + uid);
	this._config = config;
}

/**
 * @class Uploader
 */
thaira.uploads.Uploader.prototype = {
	_element : null,
	_uploadsManager : null,
	_uploadersNode : null,
	_uploadingIndicator : null,
	_config : null,

	onUploadClick : function (e) {
		// var el = Event.element(e);
		// this._element.update('<span>Uploading...</span>');
	},

	onCancelClick : function (e) {
		this._element.remove();
	},

	onSubmit : function (e) {
		this._element.hide();
		var msg = this._config.i18n.uploaderUploading;
		new Insertion.Bottom(this._uploadersNode, '<div class="msg"><span>'
				+ '<input type="button" value="" />' + msg + '</span></div>');
		this._uploadingIndicator = this._uploadersNode.immediateDescendants().last();
	},

	onUploadFinish : function (ret) {
		if (ret.result) {
			this._uploadsManager.generateAndAdd(ret.title, ret.id, ret.imgSrc);
		} else {
			alert('Error: ' + ret.message);
		}
		this._element.remove();
		this._uploadingIndicator.remove();
	}
}