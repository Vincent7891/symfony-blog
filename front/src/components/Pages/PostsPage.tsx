import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import { deletePost, getPosts, Post } from '../../api/api.ts'
import { Link } from 'react-router-dom'

const PostsPage = () => {
  const queryClient = useQueryClient()

  const {
    data: posts,
    isLoading,
    isError,
    error,
  } = useQuery<Post[]>({
    queryKey: ['posts'],
    queryFn: getPosts,
  })

  const deleteMutation = useMutation({
    mutationFn: (id: number) => deletePost(id),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['posts'] })
    },
  })

  // TO DO, add screens/alert, etc for errors, loading
  if (isLoading) return <p> Loading ... </p>
  if (isError) return <p> Error: {error?.message} </p>

  return (
    <div className="h-screen w-full flex flex-col justify-center items-center bg-gray-100">
      <h2 className="text-4xl font-bold mb-6">All Notes</h2>
      <Link
        to="/create"
        className="bg-green-500 px-4 text-white rounded-sm my-4 py-2"
      >
        Make a new post
      </Link>
      <ul className="flex flex-wrap w-2/3 gap-4 bg-gray-200 p-4 shadow-2xl">
        {posts?.map((post) => (
          <li
            className="bg-yellow-200 p-4 rounded shadow flex flex-col justify-between items-center"
            key={post.id}
          >
            <div>
              <h3 className="text-lg font-semibold text-center">
                {post.title}
              </h3>
              <p className="text-center"> {post.content}</p>
            </div>
            <div className="flex items-center justify-center gap-4 p-4">
              <Link to={`/edit/${post.id}`} className="text-blue-500">
                Edit
              </Link>
              <button
                className="bg-gray-400 rounded-2xl px-4 py-2"
                onClick={() => post.id && deleteMutation.mutate(post.id)}
              >
                Delete
              </button>
            </div>
          </li>
        ))}
      </ul>
    </div>
  )
}
export default PostsPage
