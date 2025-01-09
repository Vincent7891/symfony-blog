import { Route, Routes, useNavigate } from 'react-router-dom'
import CreatePostPage from './components/Pages/CreatePostPage.tsx'
import HomePage from './components/Pages/HomePage.tsx'
import PostsPage from './components/Pages/PostsPage.tsx'
import EditPostPage from './components/Pages/EditPostPage.tsx'

function App() {
  const navigate = useNavigate()

  return (
    <>
      <header className="bg-blue-600 text-white p-4">
        <div className="w-full flex items-center justify-center">
          <button
            className="bg-red-500 px-4 py-2 mx-4 rounded-lg"
            onClick={() => navigate(-1)}
          >
            Back
          </button>
          <h1 className="text-4xl font-bold text-center">
            Welcome to your Sticky Notes
          </h1>
        </div>
      </header>
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/create" element={<CreatePostPage />} />
        <Route path="/posts" element={<PostsPage />} />
        <Route path="/edit/:id" element={<EditPostPage />} />
      </Routes>
    </>
  )
}

export default App
