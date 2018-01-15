/**
 * @class Uploader
 * @constructor
 */
thaira.uploads.UploadersManager = function (uid, template, uploadsManager, config) {
	this._uid = uid;
	this._uploadersNode = $('uploaders' + uid);
	this._template = new Template(decodeURIComponent(template));
	this._uploaders = [];
	this._config = config;
	this._uploadsManager = uploadsManager;
}

/**
 * @class Uploader
 */
thaira.uploads.UploadersManager.prototype = {
	_uid : '',
	_uploadersNode : null,
	// _uploaderNode : null,
	_template : null,
	_uploaders : [],
	_count : 0,
	_config: null,
	_uploadsManager: null,

	generateAndAdd : function () {
	 	// Do max validation
	 	if (this._config.validation.max !== null) {
	 		if (this._uploadsManager.getCount() >= this._config.validation.max) {
	 			alert(this._config.validation.max_msg);
	 			return;
	 		}
	 	}

		var id = 'uploader' + this._uid + this._count;
		var iframeId = 'uploaderiframe' + this._uid + this._count;

		new Insertion.Bottom($$('body')[0], this._template.evaluate(
				{id : id, uid : this._uid, iframeId : iframeId, index : this._count}));

		var uploader = new thaira.uploads.Uploader(this._uid, id, this._config);
		this._uploaders.push(uploader);

		// Repositionate the Uploader form
		var addButton = this._uploadersNode.up().down(1);
		var pos = Position.page(addButton);
		var pos2 = Position.realOffset(addButton);
		$(id).setStyle({
			top: (pos[1] + pos2[1] - 125) + 'px',
			left: (pos[0] + pos2[0] - 160) + 'px'
		});

		this._count++;
	},

	getUploader : function (index) {
		return this._uploaders[index];
	}
}