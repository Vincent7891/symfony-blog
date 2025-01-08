import {Route, Routes} from "react-router-dom";
import CreatePostPage from "./components/Pages/CreatePostPage.tsx";
import HomePage from "./components/Pages/HomePage.tsx";
import PostsPage from "./components/Pages/PostsPage.tsx";

function App() {

  return (
    <>
     <header className='bg-blue-600 text-white p-4'>
         <div className='w-full flex items-center justify-center'>
             <h1 className='text-6xl font-bold'>Welcome to the cool blog</h1>
         </div>
     </header>
        <Routes>
            <Route path = '/' element={<HomePage/>}/>
            <Route path = '/create' element={<CreatePostPage/>}/>
            <Route path = '/posts' element={<PostsPage/>}/>

        </Routes>
    </>
  )
}

export default App
