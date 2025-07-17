import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const HeroSection = () => {
  const [searchQuery, setSearchQuery] = useState("");
const navigate = useNavigate();
  const searchHandler = (e) => {
    e.preventDefault();
    if(searchQuery.trim() !== ""){
      navigate(`/course/search?query=${searchQuery}`)
    }
    setSearchQuery("");
  }

  return (
    <div className="relative bg-gradient-to-r from-rose-400 to-pink-500 dark:from-[#2d2a2b] dark:to-[#9b2d3a] py-24 px-4 text-center">
      <div className="max-w-3xl mx-auto">
        <h1 className="text-gray-50 text-4xl font-bold mb-4">
          Your Learning Journey Starts Here
        </h1>
        <p className="text-gray-100 dark:text-gray-400 mb-8">
          Browse courses designed to help you grow, succeed, and thrive.
        </p>

        <form onSubmit={searchHandler} className="flex items-center bg-white dark:bg-gray-800 rounded-full shadow-lg overflow-hidden max-w-xl mx-auto mb-6">
          <Input
            type="text"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            placeholder="Search Courses"
            className="flex-grow border-none focus-visible:ring-0 px-6 py-3 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500"
          />
          <Button type="submit" className="bg-[#8b5cf6] dark:bg-[#8b5cf6] text-white px-6 py-3 rounded-r-full hover:bg-[#6d44c1] dark:hover:bg-[#6d44c1]">Search</Button>
        </form>
       <Button onClick={()=> navigate(`/course/search?query`)} className="bg-white dark:bg-gray-800 text-[#8b5cf6] dark:text-[#8b5cf6] rounded-full hover:bg-gray-200">Explore Courses</Button>
      </div>
    </div>
  );
};

export default HeroSection;
