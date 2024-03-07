function click_rep(){
    
const replyCmtElements = document.getElementsByClassName("reply-cmt");

for (let i = 0; i < replyCmtElements.length; i++) {
    const element1 = replyCmtElements[i];
    element1.addEventListener("click", function (event) {
        var parentNode = event.target.parentNode;

        // Get comment name
        var cmtName = parentNode.querySelector(".name-us").textContent;

        // Create comment element
        var commentElement = document.createElement("p");

        // Create comment text
        var commentText = document.createTextNode("Trả lời bình luận của " + cmtName);

        // Append text to comment element
        commentElement.appendChild(commentText);

        // Get comment list element
        var comment = document.getElementById("box-reply");
        var existingP = comment.querySelector("p");

        if (existingP) {
            comment.replaceChild(commentElement, existingP);
        } else {
            comment.appendChild(commentElement);
        }

        // Get user ID
        var userId = parentNode.querySelector(".us-id").textContent;
        var cmtId = parentNode.querySelector(".cmt-id").textContent;

        // Create reply input
        var replyInput = document.createElement("input");
        replyInput.type = "text";
        replyInput.name = "user_rep_id";
        replyInput.value = userId;
        replyInput.style.display = "none";
        replyInput.id = "reply-input";

        // Create comment ID input
        var cmt_id_input = document.createElement("input");
        cmt_id_input.type = "text";
        cmt_id_input.name = "rep_id";
        cmt_id_input.value = cmtId; // Assuming cmtId is defined elsewhere
        cmt_id_input.style.display = "none";
        cmt_id_input.id = "cmt-id-input";
        cmt_id_input.classList.add("cmt-id-input"); // Use classList.add for dynamic updates

        // Get comment form
        var commentForm = document.getElementById("comment");
        commentForm.appendChild(replyInput);
        commentForm.appendChild(cmt_id_input);

        comment.style.display = "block";
    });
}

var closebutton = document.getElementById("close-reply");
if(closebutton != null){
    closebutton.addEventListener("click", function (event) {
        var box_rep = document.getElementById("box-reply");
        var rep_ip = document.getElementById("reply-input");
        rep_ip.parentNode.removeChild(rep_ip);

        var ip_cmt_id = document.getElementById("cmt-id-input");
        ip_cmt_id.parentNode.removeChild(ip_cmt_id);

        var rep = box_rep.lastChild;
        box_rep.removeChild(rep);

        box_rep.style.display = "none";
    });

}

}