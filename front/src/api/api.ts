import axios from 'axios'

const api = axios.create({
  baseURL: 'http://127.0.0.1:8002',
  headers: {
    'Content-Type': 'application/json',
  },
})

export interface Post {
  id?: number
  title: string
  content: string
}

export const getPosts = async (): Promise<Post[]> => {
  const response = await api.get('/get-posts')
  return response.data
}
export const createPost = async (newPost: Post) => {
  const response = await api.post('/create-post', newPost)
  return response.data
}
export const editPost = async (post: Post) => {
  const response = await api.patch('/edit-post', {
    id: post.id,
    title: post.title,
    content: post.content,
  })
  return response.data
}
export const deletePost = async (id: number) => {
  const response = await api.delete('/delete-post', { data: { id } })
  return response.data
}
