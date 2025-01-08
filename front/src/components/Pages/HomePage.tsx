import {Link} from 'react-router-dom';

const HomePage = () => {
    return (
        <div className='min-h-screen w-full flex flex-col justify-center items-center bg-gray-100 p-4'>
            <h1 className='text-4xl font-bold mb-6'>
                this is the homepage
            </h1>
            <div className='flex gap-4'>
                <Link to='/posts' className='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors'>View posts</Link>
                <Link to='/create' className='bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors'>Create a post</Link>
            </div>
        </div>
    )
}

export default HomePage;
