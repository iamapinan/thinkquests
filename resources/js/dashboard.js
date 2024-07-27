function deletePost(postId) {
    $.ajax({
        url: '/content/' + postId,
        type: 'DELETE',
        data: {
            "_token": "{{ csrf_token() }}",
        },
        success: function(result) {
            // Handle success (e.g., show a message, remove an element)
            console.log(result.success);
        },
        error: function(request,msg,error) {
            // Handle error
            console.log('Error deleting post');
        }
    });
}