import {Post} from "../../api/api.ts";
import React, {useState} from "react";

interface PostFormProps {
    initialData?: Post;
    onSubmit: (post: Post) => void;
    submitText: string;
}

const PostForm = ({initialData, onSubmit, submitText}: PostFormProps) => {
    const [title, setTitle] = useState(initialData?.title ?? '');
    const [content, setContent] = useState(initialData?.content ?? '');

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        onSubmit({title, content, id: initialData?.id});
    }
    return (
        <form onSubmit={handleSubmit}>
            <div className="mb-4">
                <label className="block mb-2 font-semibold" htmlFor="title">Title</label>
                <input
                    id="title"
                    type="text"
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                    placeholder="enter your post's title"
                    required
                />
            </div>
            <div className="mb-4">
                <label className="block mb-2 font-semibold"  htmlFor="content">
                    <textarea
                        value={content}
                        onChange={(e) => setContent(e.target.value)}
                        placeholder="enter your post's content"
                        required
                    />
                </label>
                <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors" type="submit">{submitText}</button>
            </div>
        </form>
    )
}
export default PostForm
