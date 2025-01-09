import { Post } from '../../api/api.ts'
import React, { useState } from 'react'

interface PostFormProps {
  initialData?: Post
  onSubmit: (post: Post) => void
  submitText: string
}

const PostForm = ({ initialData, onSubmit, submitText }: PostFormProps) => {
  const [title, setTitle] = useState(initialData?.title ?? '')
  const [content, setContent] = useState(initialData?.content ?? '')

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    onSubmit({ title, content, id: initialData?.id })
  }

  return (
    <form
      className="bg-amber-200 w-1/4 rounded p-4 flex flex-col items-center justify-center"
      onSubmit={handleSubmit}
    >
      <div className="mb-4 w-full">
        <label className="block mb-2 font-semibold" htmlFor="title">
          Title
        </label>
        <input
          className="rounded w-full p-2"
          id="title"
          type="text"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          placeholder="enter your post's title"
          required
        />
      </div>
      <div className="mb-4 w-full">
        <label className="block mb-2 font-semibold" htmlFor="content">
          {' '}
          Content{' '}
        </label>
        <textarea
          className="rounded w-full p-2"
          value={content}
          onChange={(e) => setContent(e.target.value)}
          placeholder="enter your post's content"
          required
        />
        <button
          className="mt-4 block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors"
          type="submit"
        >
          {submitText}
        </button>
      </div>
    </form>
  )
}
export default PostForm
