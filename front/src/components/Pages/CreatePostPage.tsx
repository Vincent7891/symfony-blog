import {createPost, Post} from "../../api/api.ts";
import {useMutation, useQueryClient} from "@tanstack/react-query";
import {useNavigate} from "react-router-dom";
import PostForm from "../Organisms/PostForm.tsx";

const CreatePostPage = () => {
    const queryClient = useQueryClient();
    const navigate = useNavigate();

    const createMutation = useMutation({
        mutationFn: (newPost: Omit<Post, 'id'>)=> createPost(newPost),
        onSuccess: () => {
            queryClient.invalidateQueries({queryKey: ["posts"]}).then(() => navigate("/posts")
        )
        }
    });
    return (
        <div className='min-h-screen w-full flex flex-col justify-center items-center bg-gray-100 p-4'>
           <h1 className="font-semibold text-2xl">
               create post form
           </h1>
            <PostForm
                onSubmit={(data) => createMutation.mutate(data)}
                submitText={'create post'}
            />
        </div>
    )
}

export default CreatePostPage
