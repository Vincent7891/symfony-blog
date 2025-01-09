import {useNavigate, useParams} from "react-router-dom";
import {useMutation, useQuery, useQueryClient} from "@tanstack/react-query";
import {editPost, getPosts, Post} from "../../api/api.ts";
import PostForm from "../Organisms/PostForm.tsx";

const EditPostPage = () => {
    const {id} = useParams();
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const {data:posts, isLoading, isError} = useQuery<Post[]>({
        queryKey:["posts"],
        queryFn: getPosts,
    })

    const editMutation = useMutation({
        mutationFn: (post: Post)=> editPost(post),
        onSuccess: ()=>{
            queryClient.invalidateQueries({queryKey: ["posts"]});
            navigate("/posts")
        }
    })

    if(isLoading) return <p>loading ...</p>
    if(isError) return <p>error loading posts</p>;
    const postToEdit = posts?.find(post => post.id === Number(id));
    if(!postToEdit) return <p>post not found</p>;

    const handleEdit = (formData: Post) => {
        if(postToEdit.id){
            const payload = {
                id: formData.id,
                title: formData.title,
                content: formData.content,
            }
            console.log(payload)
            editMutation.mutate(payload);
        }
    }

    return(
        <div>
            <h1>Edit Post</h1>
            <PostForm initialData={postToEdit}
                      onSubmit={handleEdit}
                      submitText={'Edit Post'}/>
        </div>
    )
}

export default EditPostPage;
