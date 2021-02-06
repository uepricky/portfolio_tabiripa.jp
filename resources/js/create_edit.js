    /**
     * subPostの上下入れ替え機能 
     */
    console.log('create_edit.js');
    function upForm(formNum){
        if (formNum > 1) {
            // １つ上のsubPostNum
            let refNum = formNum - 1;
            // 上に挿入される要素の親要素
            let  parent = document.getElementById('form_' + refNum).parentNode;
            //　挿入する要素
            let targetEle = document.getElementById('form_' + formNum);
            // 上に挿入される要素
            let referenceEle = document.getElementById('form_' + refNum);
            // 挿入
            parent.insertBefore(targetEle, referenceEle);

            // referenceEle書き換え
            // 全体div
            let referenceWholeDiv = document.getElementById('form_' + refNum);
            referenceWholeDiv.id = 'form_' + formNum;
            
            // contantDiv
            let referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
            referenceSubPostDiv.id = 'subPostDiv_' + formNum;

            // delFlag
            let referenceDelFlag = document.getElementById('delFlag_' + refNum);
            referenceDelFlag.id = 'delFlag_' + formNum;
            referenceDelFlag.name = 'delFlag_' + formNum;

            // delFlagBtn
            let referenceDelFlagBtn = document.getElementById('delFlagBtn_' + refNum);
            referenceDelFlagBtn.id = 'delFlagBtn_' + formNum;
            referenceDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ formNum + ')');

            // No
            let referenceLabel = document.getElementById('subPostLabel_' + refNum);
            referenceLabel.id = 'subPostLabel_' + formNum;
            referenceLabel.innerHTML = 'No.' + formNum;

            // photo
            let referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
            referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
            referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');

            let referencePhoto = document.getElementById('sub_photo_' + refNum);
            referencePhoto.id = 'sub_photo_' + formNum;
            referencePhoto.name = 'sub_photo_' + formNum;

            // tag
            let referenceTagLabel = document.getElementById('tag_' + refNum + '_label'); 
            referenceTagLabel.id = 'tag_' + formNum + '_label'
            referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');

            let referenceTag = document.getElementById('tag_' + refNum);
            referenceTag.id = 'tag_' + formNum;
            referenceTag.name = 'tag_' + formNum;

            // commnet
            let referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
            referenceCommentLabel.id =  'comment_' + formNum + '_label';
            referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');

            let referenceComment = document.getElementById('comment_' + refNum);
            referenceComment.id = 'comment_' + formNum;
            referenceComment.name = 'comment_' + formNum;

            //upbutton
            let referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
            referenceUpbtn.id = 'upFormbtn_' + formNum;
            referenceUpbtn.setAttribute("onclick", 'upForm('+ formNum + ')');

            //downbutton
            let referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
            referenceDownbtn.id = 'downFormbtn_' + formNum;
            referenceDownbtn.setAttribute("onclick", 'downForm('+ formNum + ')');
            
            // targetEle書き換え
            // 全体div
            let targetWholeDiv = document.getElementById('form_' + formNum);
            targetWholeDiv.id = 'form_' + refNum;

            //contentDiv
            let targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
            targetSubPostDiv.id = 'subPostDiv_' + refNum;

            // delFlag
            let targetDelFlag = document.getElementById('delFlag_' + formNum);
            targetDelFlag.id = 'delFlag_' + refNum;
            targetDelFlag.name = 'delFlag_' + refNum;

            // delFlagBtn
            let targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
            targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
            targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ refNum + ')');

            // No
            let targetLabel = document.getElementById('subPostLabel_' + formNum);
            targetLabel.id = 'subPostLabel_' + refNum;
            targetLabel.innerHTML = 'No.' + refNum;

            // photo
            let targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
            targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
            targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');

            let targetPhoto = document.getElementById('sub_photo_' + formNum);
            targetPhoto.id = 'sub_photo_' + refNum;
            targetPhoto.name = 'sub_photo_' + refNum;

            // tag
            let targetTagLabel = document.getElementById('tag_' + formNum + '_label'); 
            targetTagLabel.id = 'tag_' + refNum + '_label'
            targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');

            let targetTag = document.getElementById('tag_' + formNum);
            targetTag.id = 'tag_' + refNum;
            targetTag.name = 'tag_' + refNum;

            // commnet
            let targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
            targetCommentLabel.id =  'comment_' + refNum + '_label';
            targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');

            let targetComment = document.getElementById('comment_' + formNum);
            targetComment.id = 'comment_' + refNum;
            targetComment.name = 'comment_' + refNum;

            //upbutton
            let targetUpbtn = document.getElementById('upFormbtn_' + formNum);
            targetUpbtn.id = 'upFormbtn_' + refNum;
            targetUpbtn.setAttribute("onclick", 'upForm('+ refNum + ')');

            //downbutton
            let targetDownbtn = document.getElementById('downFormbtn_' + formNum);
            targetDownbtn.id = 'downFormbtn_' + refNum;
            targetDownbtn.setAttribute("onclick", 'downForm('+ refNum + ')');
        }
    }

    function downForm(formNum) {
        let totalCount = document.getElementById('totalCount').value;

        if (formNum < totalCount ) {
            // １つ下のsubPostNum
            let refNum = formNum + 1;
            // 上に挿入される要素の親要素
            let  parent = document.getElementById('form_' + refNum).parentNode;
            // console.log(parent);
            //　挿入する要素
            let targetEle = document.getElementById('form_' + formNum);
            //console.log(targetEle);
            // 上に挿入される要素
            let referenceEle = document.getElementById('form_' + refNum);
            console.log(referenceEle);
            // 挿入
            parent.insertBefore(targetEle, referenceEle.nextSibling);

            // targetEle書き換え
            // 全体div
            let targetWholeDiv = document.getElementById('form_' + formNum);
            targetWholeDiv.id = 'form_' + refNum;

            //contentDiv
            let targetSubPostDiv = document.getElementById('subPostDiv_' + formNum);
            targetSubPostDiv.id = 'subPostDiv_' + refNum;

            // delFlag
            let targetDelFlag = document.getElementById('delFlag_' + formNum);
            targetDelFlag.id = 'delFlag_' + refNum;
            targetDelFlag.name = 'delFlag_' + refNum;

            // delFlagBtn
            let targetDelFlagBtn = document.getElementById('delFlagBtn_' + formNum);
            targetDelFlagBtn.id = 'delFlagBtn_' + refNum;
            targetDelFlagBtn.setAttribute("onclick", 'delFlagBtn('+ refNum + ')');

            // No
            let targetLabel = document.getElementById('subPostLabel_' + formNum);
            targetLabel.id = 'subPostLabel_' + refNum;
            targetLabel.innerHTML = 'No.' + refNum;

            // photo
            let targetPhotoLabel = document.getElementById('sub_photo_' + formNum + '_label');
            targetPhotoLabel.id = 'sub_photo_' + refNum + '_label';
            targetPhotoLabel.setAttribute("for", 'sub_photo_' + refNum + '_label');

            let targetPhoto = document.getElementById('sub_photo_' + formNum);
            targetPhoto.id = 'sub_photo_' + refNum;
            targetPhoto.name = 'sub_photo_' + refNum;

            // tag
            let targetTagLabel = document.getElementById('tag_' + formNum + '_label'); 
            targetTagLabel.id = 'tag_' + refNum + '_label'
            targetTagLabel.setAttribute("for", 'tag_' + refNum + '_label');

            let targetTag = document.getElementById('tag_' + formNum);
            targetTag.id = 'tag_' + refNum;
            targetTag.name = 'tag_' + refNum;

            // commnet
            let targetCommentLabel = document.getElementById('comment_' + formNum + '_label');
            targetCommentLabel.id =  'comment_' + refNum + '_label';
            targetCommentLabel.setAttribute("for", 'comment_' + refNum + '_label');

            let targetComment = document.getElementById('comment_' + formNum);
            targetComment.id = 'comment_' + refNum;
            targetComment.name = 'comment_' + refNum;

            //upbutton
            let targetUpbtn = document.getElementById('upFormbtn_' + formNum);
            targetUpbtn.id = 'upFormbtn_' + refNum;
            targetUpbtn.setAttribute("onclick", 'upForm('+ refNum + ')');

            //downbutton
            let targetDownbtn = document.getElementById('downFormbtn_' + formNum);
            targetDownbtn.id = 'downFormbtn_' + refNum;
            targetDownbtn.setAttribute("onclick", 'downForm('+ refNum + ')');

            // referenceEle書き換え
            // 全体div
            let referenceWholeDiv = document.getElementById('form_' + refNum);
            referenceWholeDiv.id = 'form_' + formNum;

            // contantDiv
            let referenceSubPostDiv = document.getElementById('subPostDiv_' + refNum);
            referenceSubPostDiv.id = 'subPostDiv_' + formNum;

            // delFlag
            let referenceDelFlag = document.getElementById('delFlag_' + refNum);
            referenceDelFlag.id = 'delFlag_' + formNum;
            referenceDelFlag.name = 'delFlag_' + formNum;

            // delFlagBtn
            let referenceFlagBtn = document.getElementById('delFlagBtn_' + refNum);
            referenceFlagBtn.id = 'delFlagBtn_' + formNum;
            referenceFlagBtn.setAttribute("onclick", 'delFlagBtn('+ formNum + ')');

            // No
            let referenceLabel = document.getElementById('subPostLabel_' + refNum);
            referenceLabel.id = 'subPostLabel_' + formNum;
            referenceLabel.innerHTML = 'No.' + formNum;

            // photo
            let referencePhotoLabel = document.getElementById('sub_photo_' + refNum + '_label');
            referencePhotoLabel.id = 'sub_photo_' + formNum + '_label';
            referencePhotoLabel.setAttribute("for", 'sub_photo_' + formNum + '_label');

            let referencePhoto = document.getElementById('sub_photo_' + refNum);
            referencePhoto.id = 'sub_photo_' + formNum;
            referencePhoto.name = 'sub_photo_' + formNum;

            // tag
            let referenceTagLabel = document.getElementById('tag_' + refNum + '_label'); 
            referenceTagLabel.id = 'tag_' + formNum + '_label'
            referenceTagLabel.setAttribute("for", 'tag_' + formNum + '_label');

            let referenceTag = document.getElementById('tag_' + refNum);
            referenceTag.id = 'tag_' + formNum;
            referenceTag.name = 'tag_' + formNum;

            // commnet
            let referenceCommentLabel = document.getElementById('comment_' + refNum + '_label');
            referenceCommentLabel.id =  'comment_' + formNum + '_label';
            referenceCommentLabel.setAttribute("for", 'comment_' + formNum + '_label');

            let referenceComment = document.getElementById('comment_' + refNum);
            referenceComment.id = 'comment_' + formNum;
            referenceComment.name = 'comment_' + formNum;

            //upbutton
            let referenceUpbtn = document.getElementById('upFormbtn_' + refNum);
            referenceUpbtn.id = 'upFormbtn_' + formNum;
            referenceUpbtn.setAttribute("onclick", 'upForm('+ formNum + ')');

            //downbutton
            let referenceDownbtn = document.getElementById('downFormbtn_' + refNum);
            referenceDownbtn.id = 'downFormbtn_' + formNum;
            referenceDownbtn.setAttribute("onclick", 'downForm('+ formNum + ')');
        }
    }

    /**
     * preview機能
     */

    function previewImage(obj)
    {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            var canvas = document.getElementById('preview');
            var ctx = canvas.getContext('2d');
            var image = new Image();
            image.src = fileReader.result;
            image.onload = (function () {
                canvas.width = image.width;
                canvas.height = image.height;
                ctx.drawImage(image, 0, 0);
            });
        });
        fileReader.readAsDataURL(obj.files[0]);
    }
