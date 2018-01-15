/**
 * @class Config
 * @constructor
 */
thaira.uploads.Config = function (obj) {
	Object.extend(this, obj);
}

thaira.uploads.Config.prototype = {
	uid : null,
	actionsUrl : null,

	uploadTemplate : null,

	editorTemplate : null,
	editorFields : null,

	validation : {
		max : null,
		max_msg : null
	},

	i18n : {
		uploadRemoveAlertMsg : 'Are you sure you want to remove this item?',
		uploaderUploading : 'Uploading the file...'
	}
}