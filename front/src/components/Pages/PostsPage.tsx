import {useMutation, useQuery, useQueryClient} from "@tanstack/react-query";
import {deletePost, getPosts, Post} from "../../api/api.ts";
import {Link} from "react-router-dom";

const PostsPage = () => {
    const queryClient = useQueryClient();

    const {data: posts, isLoading, isError, error} = useQuery<Post[]>({
        queryKey: ["posts"],
        queryFn: getPosts
    })

    const deleteMutation = useMutation({
        mutationFn: (id: number) => deletePost(id),
        onSuccess: () => {
            queryClient.invalidateQueries({queryKey: ["posts"]})
        }
    })

    if (isLoading) return <p> Loading ... </p>
    if (isError) return <p> Error: {error?.message} </p>

    return (
        <div>
            <div className='min-h-screen w-full flex flex-col justify-center items-center bg-gray-100 p-4'>
                <h2 className='text-4xl font-bold'>
                    All Posts
                </h2>
                <Link to="/create" className="bg-green-500 px-4 py-2 text-white rounded">Create Post</Link>
                <ul className="flex flex-wrap w-1/2 gap-4">
                    {posts?.map((post) => (
                        <li className="bg-white p-4 rounded shadow flex justify-between items-center" key={post.id}>
                            <div>
                                <h3 className="text-lg font-semibold">{post.title}</h3>
                                <p> {post.content}</p>
                                <p> ID IS {post.id}</p>
                            </div>
                            <div className="flex flex-col items-center justify-center p-4">
                                <Link to={`/edit/${post.id}`} className="text-blue-500">Edit</Link>
                                {/*disabled until merge of delete later*/}
                                <button className="bg-gray-400 rounded-2xl px-4 py-2 hover:cursor-not-allowed"  disabled={true}  onClick={()=> post.id && deleteMutation.mutate(post.id)}>Delete</button>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    )
}
export default PostsPage;
