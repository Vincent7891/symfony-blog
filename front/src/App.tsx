import HomePage from "./components/Pages/PostsPage.tsx";
import {Route, Routes} from "react-router-dom";

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
        </Routes>
    </>
  )
}

export default App
