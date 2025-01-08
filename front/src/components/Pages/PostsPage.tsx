import {Link} from 'react-router-dom';

const HomePage = () => {
    return (
        <div className='min-h-screen w-full flex flex-col justify-center items-center bg-gray-100 p-4'>
            <h1 className='text-4xl font-bold mb-6'>
                this is the homepage
            </h1>
            <div className='flex gap-4'>
                <Link to='/posts'>View posts</Link>
                <Link to='/create'>Create a post</Link>
            </div>
        </div>
    )
}

export default HomePage;
